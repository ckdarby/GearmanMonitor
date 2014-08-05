<?php
namespace GearmanMonitor\Controller;

class ServerController
{

    public $serverService;

    public function __construct($app)
    {
        $this->serverService = $app['server.service'];
        $this->twig = $app['twig'];
        $this->servers = $app['config.GearmanMonitor']['servers'];
    }

    public function indexAction()
    {
        $servers = $this->serverService->getStatuses($this->servers);
        return $this->twig->render('server.twig', [
            'servers' => $servers
        ]);
    }
}