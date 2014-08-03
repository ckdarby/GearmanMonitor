<?php
namespace GearmanMonitor\Controller;

class WorkerController
{

    public $WorkerService;

    public function __construct($twig, $WorkerService)
    {
        $this->WorkerService = $WorkerService;
        $this->twig = $twig;
    }

    public function indexAction()
    {
        return [];
    }
}