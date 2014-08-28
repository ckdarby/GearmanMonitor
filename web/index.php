<?PHP
require_once __DIR__.'/../vendor/autoload.php';

try {
    //Silex setup
    $app = new Silex\Application();
    $app->register(new Silex\Provider\ServiceControllerServiceProvider());
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../src/GearmanMonitor/Resources/views',
    ));

    //Configuration
    $app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__.'/../src/GearmanMonitor/Resources/config/config.yml'));

    //Server
    $app['server.service'] = $app->share(function() {
        return new GearmanMonitor\Service\ServerService;
    });
    $app['server.controller'] = $app->share(function() use ($app) {
        return new GearmanMonitor\Controller\ServerController($app);
    });

    //Queue
    $app['queue.service'] = $app->share(function() {
        return new GearmanMonitor\Service\QueueService;
    });
    $app['queue.controller'] = $app->share(function() use ($app) {
        return new GearmanMonitor\Controller\QueueController($app);
    });

    //Worker
    $app['worker.service'] = $app->share(function() {
        return new GearmanMonitor\Service\WorkerService;
    });
    $app['worker.controller'] = $app->share(function() use ($app) {
        return new GearmanMonitor\Controller\WorkerController($app);
    });


    //Set Routes
    $app->get('/', "server.controller:indexAction");
    $app->get('/server', "server.controller:indexAction");
    $app->get('/queue', "queue.controller:indexAction");
    $app->get('/worker', "worker.controller:indexAction");

$app->run();

} catch (Exception $e) {
    echo $e->getMessage();
}