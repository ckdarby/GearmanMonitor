<?php
namespace GearmanMonitor\Service;
use Net\Gearman\Manager;

class WorkerService
{

    public function __construct()
    {

    }

    public function getWorkers($servers)
    {
        foreach($servers as &$server){
            try {
                $germanManager = new Manager($server['address']);
                $workers = $germanManager->workers();
                foreach($workers as $worker){
                    $server['workers'][] = $worker;
                }
            } catch (\Exception $e) {
                $server['workers'] = [];
            }
        }
        return $servers;
    }
}