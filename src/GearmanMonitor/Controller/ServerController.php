<?php
namespace GearmanMonitor\Controller;

class ServerController
{

    public $serverService;

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
            ],
            [
                'address' => '192.168.155.1',
                'name' => 'CHARMANDER'
            ]
        ];
        $servers = $this->serverService->getStatuses($servers);
        return $this->twig->render('server.twig', [
            'servers' => $servers
        ]);
    }
}