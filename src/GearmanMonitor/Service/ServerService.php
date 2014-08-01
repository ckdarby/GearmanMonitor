<?php
namespace GearmanMonitor\Service;
use Net\Gearman\Manager;

class ServerService
{
    public $servers;

    public function __construct()
    {

    }

    public function getStatuses($servers)
    {
        foreach($servers as &$server){
            try {
                $germanManager = new Manager($server['address']);
                $server['version'] = $germanManager->version();
            } catch (Exception $e) {
                $server['version'] = 'None';
            }
        }
        return $servers;
    }
}