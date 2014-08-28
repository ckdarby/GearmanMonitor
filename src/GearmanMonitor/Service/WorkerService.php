<?php
namespace GearmanMonitor\Service;
use Net\Gearman\Manager;

class WorkerService
{

    /**
     * Given a list of servers gets all workers
     *
     * @param array Server addresses
     * @return array Servers with appended worker info
     */
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
                //Unable to connect or worker unresponsive
                $server['workers'] = [];
            }
        }
        return $servers;
    }
}