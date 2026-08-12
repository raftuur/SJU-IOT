<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\MonitoringService;

class MachineSensorController extends BaseController
{
    protected MonitoringService $monitoringService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
    }

    public function sensor()
    {
        // nanti kita pindahkan isi method sensor ke sini
    }
}