<?php

namespace App\Services;

use App\Models\MachineModel;
use App\Models\MachineLogModel;
use App\Models\SensorLogModel;

class MonitoringService
{
    protected MachineModel $machineModel;
    protected MachineLogModel $machineLogModel;
    protected SensorLogModel $sensorLogModel;

    public function __construct()
    {
        $this->machineModel = new MachineModel();
        $this->machineLogModel = new MachineLogModel();
        $this->sensorLogModel = new SensorLogModel();
    }

    /**
     * Ringkasan dashboard monitoring
     */
    public function getDashboardSummary(): array
    {
        $machines = $this->getMachineList();

        $online = 0;
        $offline = 0;
        $maintenance = 0;

        foreach ($machines as $machine) {

            switch ($machine['realtime_status']) {

                case 'online':
                    $online++;
                    break;

                case 'maintenance':
                    $maintenance++;
                    break;

                default:
                    $offline++;
                    break;
            }
        }

        return [

            'totalMachine' => count($machines),

            'online' => $online,

            'offline' => $offline,

            'maintenance' => $maintenance,

        ];
    }

    /**
     * Daftar seluruh machine dengan status real-time
     */
    public function getMachineList(): array
    {
        $machines = $this->machineModel
            ->orderBy('machine_code', 'ASC')
            ->findAll();

        foreach ($machines as &$machine) {

            // Status maintenance tetap diprioritaskan
            if ($machine['status'] === 'maintenance') {

                $machine['realtime_status'] = 'maintenance';

            } else {

                $machine['realtime_status'] = $this->isMachineOnline(
                    $machine['heartbeat_at']
                )
                    ? 'online'
                    : 'offline';

            }

        }

        return $machines;
    }

    /**
     * Detail satu machine dengan status real-time
     */
    public function getMachineDetail(int $id): ?array
    {
        $machine = $this->machineModel->find($id);

        if (!$machine) {
            return null;
        }

        // Status realtime
        if ($machine['status'] === 'maintenance') {

            $machine['realtime_status'] = 'maintenance';

        } else {

            $machine['realtime_status'] = $this->isMachineOnline(
                $machine['heartbeat_at']
            )
                ? 'online'
                : 'offline';
        }

        // Data sensor terakhir
        $machine['sensor'] = [
            'weight'      => (float) ($machine['last_weight'] ?? 0),
            'bin_level'   => (int) ($machine['last_bin_level'] ?? 0),
            'temperature' => (float) ($machine['last_temperature'] ?? 0),
            'wifi_rssi'   => (int) ($machine['last_wifi_rssi'] ?? 0),
            'voltage'     => (float) ($machine['last_voltage'] ?? 0),
        ];

        return $machine;
    }

    /**
     * Update heartbeat dari ESP32
     */
    public function updateHeartbeat(
        string $machineCode,
        ?string $firmwareVersion,
        ?string $ipAddress
    ): bool {

        $machine = $this->machineModel
            ->where('machine_code', $machineCode)
            ->first();

        if (!$machine) {
            return false;
        }

        $this->machineModel->update($machine['id'], [

            'heartbeat_at'       => date('Y-m-d H:i:s'),

            'last_online'        => date('Y-m-d H:i:s'),

            'firmware_version'   => $firmwareVersion ?: $machine['firmware_version'],

            'ip_address'         => $ipAddress ?: $machine['ip_address'],

        ]);

        return true;
    }

    /**
     * Update data sensor dari ESP32
     */
    public function updateSensorData(
        string $machineCode,
        float $weight,
        int $binLevel,
        float $temperature,
        int $wifiRssi,
        float $voltage
    ): bool {

        $machine = $this->machineModel
            ->where('machine_code', $machineCode)
            ->first();

        if (!$machine) {
            return false;
        }

        // Update kondisi terbaru machine
        $this->machineModel->update($machine['id'], [

            'last_weight'      => $weight,
            'last_bin_level'   => $binLevel,
            'last_temperature' => $temperature,
            'last_wifi_rssi'   => $wifiRssi,
            'last_voltage'     => $voltage,

        ]);

        // Simpan histori sensor
        $this->sensorLogModel->insert([

            'machine_id'   => $machine['id'],
            'weight'       => $weight,
            'bin_level'    => $binLevel,
            'temperature'  => $temperature,
            'wifi_rssi'    => $wifiRssi,
            'voltage'      => $voltage,
            'created_at'   => date('Y-m-d H:i:s'),

        ]);

        // Catat aktivitas menggunakan method writeMachineLog
        $this->writeMachineLog(
            $machine['id'],
            'SENSOR_UPDATE',
            'Data sensor berhasil diperbarui.'
        );

        return true;
    }

    /**
     * Ambil aktivitas terbaru machine
     */
    public function getMachineActivities(int $machineId, int $limit = 10): array
    {
        return $this->machineLogModel
            ->where('machine_id', $machineId)
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    /**
     * Cek apakah machine masih online
     */
    public function isMachineOnline(?string $heartbeatAt): bool
    {
        if (empty($heartbeatAt)) {
            return false;
        }

        return strtotime($heartbeatAt) >= strtotime('-30 seconds');
    }

    /**
     * Simpan aktivitas machine
     */
    private function writeMachineLog(
        int $machineId,
        string $activity,
        string $description
    ): void {

        $this->machineLogModel->insert([

            'machine_id'  => $machineId,

            'activity'    => $activity,

            'description' => $description,

        ]);
    }
}