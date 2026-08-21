<?php

namespace App\Controllers;

use App\Services\MonitoringService;

class MonitoringController extends BaseController
{
    protected MonitoringService $monitoringService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
    }

    public function index()
    {
        $machines = $this->monitoringService->getMachineList();

        $summary = $this->monitoringService->getDashboardSummary();

        return view('admin/monitoring/index', [
            'title'         => 'Monitoring Machine',
            'pageTitle'     => 'Monitoring Machine',
            'pageSubtitle'  => 'Monitoring realtime seluruh Reverse Vending Machine.',
            'machines'      => $machines,
            'totalMachine'  => $summary['totalMachine'],
            'online'        => $summary['online'],
            'offline'       => $summary['offline'],
            'maintenance'   => $summary['maintenance'],
        ]);
    }

    public function show($id)
    {
        $machine = $this->monitoringService->getMachineDetail((int) $id);

        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Machine tidak ditemukan.'
            );
        }

        $activities = $this->monitoringService->getMachineActivities(
            (int) $id,
            10
        );

        return view('admin/monitoring/show', [
            'title'        => 'Monitoring Machine',
            'pageTitle'    => $machine['machine_code'],
            'pageSubtitle' => 'Monitoring realtime mesin Reverse Vending Machine.',
            'machine'      => $machine,
            'activities'   => $activities,
        ]);
    }
}