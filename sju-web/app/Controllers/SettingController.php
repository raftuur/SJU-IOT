<?php

namespace App\Controllers;

use App\Services\SettingService;

class SettingController extends BaseController
{
    protected SettingService $settingService;

    public function __construct()
    {
        $this->settingService = new SettingService();
    }

    public function index()
    {
        return view('admin/setting/index', [

            'title'        => 'Setting',

            'pageTitle'    => 'Setting',

            'pageSubtitle' => 'Kelola konfigurasi sistem SJU.',

            'settings'     => $this->settingService->getAll(),

        ]);
    }

    public function update()
    {
        $settings = [

            [
                'key'   => 'system_name',
                'value' => $this->request->getPost('system_name'),
                'group' => 'system',
            ],

            [
                'key'   => 'system_description',
                'value' => $this->request->getPost('system_description'),
                'group' => 'system',
            ],

            [
                'key'   => 'point_per_bottle',
                'value' => $this->request->getPost('point_per_bottle'),
                'group' => 'point',
            ],

            [
                'key'   => 'minimum_point',
                'value' => $this->request->getPost('minimum_point'),
                'group' => 'point',
            ],

            [
                'key'   => 'ai_service_url',
                'value' => $this->request->getPost('ai_service_url'),
                'group' => 'ai',
            ],

            [
                'key'   => 'ai_confidence',
                'value' => $this->request->getPost('ai_confidence'),
                'group' => 'ai',
            ],

            [
                'key'   => 'ai_detection_status',
                'value' => $this->request->getPost('ai_detection_status') ? '1' : '0',
                'group' => 'ai',
            ],

            [
                'key'   => 'communication_interval',
                'value' => $this->request->getPost('communication_interval'),
                'group' => 'machine',
            ],

            [
                'key'   => 'offline_timeout',
                'value' => $this->request->getPost('offline_timeout'),
                'group' => 'machine',
            ],

        ];

        $this->settingService->setMultiple($settings);

        return redirect()
            ->to('/setting')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}