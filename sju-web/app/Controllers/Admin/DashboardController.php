<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MachineModel;
use App\Models\TransactionModel;
use App\Models\MachineSessionModel;
use App\Models\SensorLogModel;
use App\Models\RewardRedemptionModel;
use App\Models\WithdrawalModel;

class DashboardController extends BaseController
{
    protected UserModel $userModel;
    protected MachineModel $machineModel;
    protected TransactionModel $transactionModel;
    protected MachineSessionModel $machineSessionModel;
    protected SensorLogModel $sensorLogModel;
    protected RewardRedemptionModel $rewardRedemptionModel;
    protected WithdrawalModel $withdrawalModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->machineModel = new MachineModel();
        $this->transactionModel = new TransactionModel();
        $this->machineSessionModel = new MachineSessionModel();
        $this->sensorLogModel = new SensorLogModel();
        $this->rewardRedemptionModel = new RewardRedemptionModel();
        $this->withdrawalModel = new WithdrawalModel();
    }

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalUser = $this->userModel->countAllResults();

        $totalMachine = $this->machineModel->countAllResults();

        $totalTransaction = $this->transactionModel->countAllResults();

        $totalBottle = $this->transactionModel
            ->selectSum('bottle_count')
            ->get()
            ->getRow()
            ->bottle_count ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Machine
        |--------------------------------------------------------------------------
        */

        $machines = $this->machineModel
            ->orderBy('id', 'ASC')
            ->findAll();


        /*
        |--------------------------------------------------------------------------
        | Machine Terpilih
        |--------------------------------------------------------------------------
        */

        $machineId = $this->request->getGet('machine_id');

        $selectedMachine = null;

        if (!empty($machineId)) {

            $selectedMachine = $this->machineModel
                ->find($machineId);

        }

        if (empty($selectedMachine) && !empty($machines)) {

            $selectedMachine = $machines[0];

        }


        /*
        |--------------------------------------------------------------------------
        | Sensor Terakhir
        |--------------------------------------------------------------------------
        */

        $latestSensor = null;

        if (!empty($selectedMachine)) {

            $latestSensor = $this->sensorLogModel
                ->where(
                    'machine_id',
                    $selectedMachine['id']
                )
                ->orderBy(
                    'created_at',
                    'DESC'
                )
                ->first();

        }


        /*
        |--------------------------------------------------------------------------
        | Active Session
        |--------------------------------------------------------------------------
        */

        $activeSession = $this->machineSessionModel
            ->select(
                'machine_sessions.*,
                 machines.machine_code,
                 machines.machine_name,
                 users.fullname'
            )
            ->join(
                'machines',
                'machines.id = machine_sessions.machine_id',
                'left'
            )
            ->join(
                'users',
                'users.id = machine_sessions.user_id',
                'left'
            )
            ->where(
                'machine_sessions.status',
                'active'
            )
            ->orderBy(
                'machine_sessions.started_at',
                'DESC'
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Grafik Penukaran Botol
        |--------------------------------------------------------------------------
        */

        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = date('Y-m-d', strtotime("-{$i} days"));

            $result = $this->transactionModel
                ->selectSum('bottle_count')
                ->where('DATE(created_at)', $date)
                ->first();

            $chartData[] = [
                'date'   => $date,
                'bottle' => (int) ($result['bottle_count'] ?? 0),
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Aktivitas Terbaru
        |--------------------------------------------------------------------------
        */

        $activities = [];


        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        $transactions = $this->transactionModel
            ->select('transaction_code, bottle_count, point_earned, created_at')
            ->orderBy('created_at', 'DESC')
            ->findAll(4);

        foreach ($transactions as $transaction) {

            $activities[] = [

                'type' => 'transaction',

                'icon' => 'bi-recycle',

                'color' => 'bg-warning',

                'title' => 'Botol berhasil diterima',

                'description' =>
                    $transaction['transaction_code']
                    . ' • '
                    . ($transaction['bottle_count'] ?? 0)
                    . ' botol',

                'time' => $transaction['created_at'],

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | Reward Redemption
        |--------------------------------------------------------------------------
        */

        $redemptions = $this->rewardRedemptionModel
            ->select('redemption_code, point, status, created_at')
            ->orderBy('created_at', 'DESC')
            ->findAll(4);

        foreach ($redemptions as $redemption) {

            $activities[] = [

                'type' => 'redemption',

                'icon' => 'bi-gift',

                'color' => 'bg-primary',

                'title' => 'Penukaran reward dilakukan',

                'description' =>
                    $redemption['redemption_code']
                    . ' • '
                    . ($redemption['point'] ?? 0)
                    . ' point',

                'time' => $redemption['created_at'],

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | Withdrawal
        |--------------------------------------------------------------------------
        */

        $withdrawals = $this->withdrawalModel
            ->select('withdrawal_code, point_used, amount, status, created_at')
            ->orderBy('created_at', 'DESC')
            ->findAll(4);

        foreach ($withdrawals as $withdrawal) {

            $activities[] = [

                'type' => 'withdrawal',

                'icon' => 'bi-cash-coin',

                'color' => 'bg-info',

                'title' => 'Pengajuan withdrawal',

                'description' =>
                    $withdrawal['withdrawal_code']
                    . ' • Rp '
                    . number_format(
                        (float) ($withdrawal['amount'] ?? 0),
                        0,
                        ',',
                        '.'
                    ),

                'time' => $withdrawal['created_at'],

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | Machine Session
        |--------------------------------------------------------------------------
        */

        $sessions = $this->machineSessionModel
            ->select(
                'machine_sessions.started_at,
                 machine_sessions.status,
                 machines.machine_code,
                 users.fullname'
            )
            ->join(
                'machines',
                'machines.id = machine_sessions.machine_id',
                'left'
            )
            ->join(
                'users',
                'users.id = machine_sessions.user_id',
                'left'
            )
            ->orderBy(
                'machine_sessions.started_at',
                'DESC'
            )
            ->findAll(4);

        foreach ($sessions as $session) {

            $activities[] = [

                'type' => 'session',

                'icon' => 'bi-qr-code-scan',

                'color' => 'bg-success',

                'title' => 'Session machine dimulai',

                'description' =>
                    ($session['machine_code'] ?? '-')
                    . ' • '
                    . ($session['fullname'] ?? 'User'),

                'time' => $session['started_at'],

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | Urutkan Semua Aktivitas
        |--------------------------------------------------------------------------
        */

        usort($activities, function ($a, $b) {

            return strtotime($b['time']) <=> strtotime($a['time']);

        });


        /*
        |--------------------------------------------------------------------------
        | Ambil 4 Aktivitas Terbaru
        |--------------------------------------------------------------------------
        */

        $activities = array_slice($activities, 0, 4);


        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('admin/dashboard/index', [

            'title' => 'Dashboard',

            'pageTitle' => 'Dashboard',

            'pageSubtitle' =>
                'Pantau seluruh aktivitas Reverse Vending Machine dari sini.',


            // Statistik

            'totalUser' => $totalUser,

            'totalMachine' => $totalMachine,

            'totalTransaction' => $totalTransaction,

            'totalBottle' => $totalBottle,


            // Machine

            'machines' => $machines,

            'selectedMachine' => $selectedMachine,


            // Sensor

            'latestSensor' => $latestSensor,


            // Session

            'activeSession' => $activeSession,


            // Grafik

            'chartData' => $chartData,


            // Aktivitas

            'activities' => $activities,

        ]);
    }
}