<?PHP
require_once __DIR__.'/../vendor/autoload.php';
use GearmanMonitor\Controller\ServerController;

$app = new Silex\Application();
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/GearmanMonitor/Resources/views',
));
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__.'/../src/GearmanMonitor/Resources/config/config.yml'));

//Server
$app['server.service'] = $app->share(function() {
    return new GearmanMonitor\Service\ServerService;
});
$app['server.controller'] = $app->share(function() use ($app) {
    return new ServerController($app);
});

//Queue
$app['queue.service'] = $app->share(function() {
    return new GearmanMonitor\Service\QueueService;
});
$app['queue.controller'] = $app->share(function() use ($app) {
    return new QueueController($app);
});

//Worker
$app['worker.service'] = $app->share(function() {
    return new GearmanMonitor\Service\workerService;
});
$app['worker.controller'] = $app->share(function() use ($app) {
    return new workerController($app);
});

$app->get('/', "server.controller:indexAction");
$app->get('/server', "server.controller:indexAction");
$app->get('/queue', "queue.controller:indexAction");
$app->get('/worker', "queue.controller:indexAction");

$app->run();