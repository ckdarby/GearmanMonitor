<?php
namespace GearmanMonitor\Controller;

class WorkerController
{

    public $workerService;
    public $twig;
    public $servers;

    public function __construct($app)
    {
        $this->workerService = $app['worker.service'];
        $this->twig = $app['twig'];
        $this->servers = $app['config.GearmanMonitor']['servers'];
    }

    public function indexAction()
    {
        $servers = $this->workerService->getWorkers($this->servers);
        return $this->twig->render('worker.twig', [
            'servers' => $servers
        ]);
    }
}