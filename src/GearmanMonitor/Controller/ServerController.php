<?php
namespace GearmanMonitor\Controller;

class ServerController
{

    public function __construct($twig, $serverService)
    {
        $this->serverService = $serverService;
        $this->twig = $twig;
    }

    public function indexAction()
    {
        $servers = [
            [
                'address' => '127.0.0.1',
                'name' => 'KAPPA'
            ]
        ];
        $servers = $this->serverService->getStatuses($servers);
        return $this->twig->render('main.twig', [
            $servers
        ]);
    }
}