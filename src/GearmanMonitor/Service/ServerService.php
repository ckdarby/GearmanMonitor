<?php
namespace GearmanMonitor\Service;
use Net\Gearman\Manager;

class ServerService
{

    /**
     * Given a list of servers gets the versions if possible
     *
     * @param array Server addresses
     * @return array Servers with appended version info
     */
    public function getStatuses($servers)
    {
        foreach($servers as &$server){
            try {
                $germanManager = new Manager($server['address']);
                $server['version'] = $germanManager->version();
            } catch (\Exception $e) {
                //Unable to connect to server
                $server['version'] = 'None';
            }
        }
        return $servers;
    }
}