<?php
namespace GearmanMonitor\Service;
use Net\Gearman\Manager;

class QueueService
{

    /**
     * Given a list of servers gets the current queue from them
     *
     * @param array Server addresses
     * @return array Servers with appended queue info
     */
    public function getQueue($servers)
    {
        foreach($servers as &$server){
            try {
                $germanManager = new Manager($server['address']);
                $server['queue'] = $germanManager->status();
            } catch (\Exception $e) {
                //Unable to connect to server or workers unresponsive
                $server['queue'] = [];
            }
        }

        return $servers;
    }
}