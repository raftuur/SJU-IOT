<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\MonitoringService;

class MachineHeartbeatController extends BaseController
{
    protected MonitoringService $monitoringService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
    }

    public function heartbeat()
    {
        // nanti kita pindahkan isi method heartbeat ke sini
    }
}