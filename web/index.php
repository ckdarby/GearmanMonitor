<?PHP
require_once __DIR__.'/../vendor/autoload.php';
use GearmanMonitor\Controller\ServerController;

$app = new Silex\Application();
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/GearmanMonitor/Resources/views',
));


$app['server.service'] = $app->share(function() {
    return new GearmanMonitor\Service\ServerService;
});

$app['server.controller'] = $app->share(function() use ($app) {
    return new ServerController($app['twig'], $app['server.service']);
});

$app->get('/', "server.controller:indexAction");
$app->get('/servers', "server.controller:indexAction");


$app->run();