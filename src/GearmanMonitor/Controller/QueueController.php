<?php
namespace GearmanMonitor\Controller;

class QueueController
{

    public $workerService;
    public $twig;
    public $servers;

    public function __construct($app)
    {
        $this->queueService = $app['queue.service'];
        $this->twig = $app['twig'];
        $this->servers = $app['config.GearmanMonitor']['servers'];
    }

    public function indexAction()
    {
        $servers = $this->queueService->getQueue($this->servers);
        return $this->twig->render('queue.twig', [
            'servers' => $servers
        ]);
    }
}