<?php
namespace GearmanMonitor\Controller;

class QueueController
{

    public $queueService;

    public function __construct($twig, $queueService)
    {
        $this->queueService = $queueService;
        $this->twig = $twig;
    }

    public function indexAction()
    {
        return [];
    }
}