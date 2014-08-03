<?PHP
require_once __DIR__.'/../vendor/autoload.php';
use GearmanMonitor\Controller\ServerController;

$app = new Silex\Application();
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/GearmanMonitor/Resources/views',
));


//Server
$app['server.service'] = $app->share(function() {
    return new GearmanMonitor\Service\ServerService;
});
$app['server.controller'] = $app->share(function() use ($app) {
    return new ServerController($app['twig'], $app['server.service']);
});

//Queue
$app['queue.service'] = $app->share(function() {
    return new GearmanMonitor\Service\QueueService;
});
$app['queue.controller'] = $app->share(function() use ($app) {
    return new QueueController($app['twig'], $app['queue.service']);
});

//Worker
$app['worker.service'] = $app->share(function() {
    return new GearmanMonitor\Service\workerService;
});
$app['worker.controller'] = $app->share(function() use ($app) {
    return new workerController($app['twig'], $app['worker.service']);
});

$app->get('/', "server.controller:indexAction");
$app->get('/server', "server.controller:indexAction");
$app->get('/queue', "queue.controller:indexAction");
$app->get('/worker', "queue.controller:indexAction");

$app->run();