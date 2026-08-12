<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\RewardRedemptionService;

class RewardController extends BaseController
{
    protected RewardRedemptionService $rewardRedemptionService;

    public function __construct()
    {
        $this->rewardRedemptionService = new RewardRedemptionService();
    }

    /**
     * Daftar Reward
     */
    public function index()
    {
        if (! session()->get('isLoggedIn')) {

            return redirect()->to('/auth/login');

        }

        $userId = session()->get('userId');

        $rewards = array_filter(

            $this->rewardRedemptionService->getAll(),

            static function ($reward) use ($userId) {

                return (int) $reward['user_id'] === (int) $userId;

            }

        );

        return view('user/reward/index', [

            'title'         => 'Reward',

            'pageTitle'     => 'Reward',

            'pageSubtitle'  => 'Riwayat penukaran voucher.',

            'rewards'       => $rewards,

        ]);
    }

    /**
     * Detail Reward
     */
    public function show(int $id)
    {
        $reward = $this->rewardRedemptionService
            ->getDetail($id);

        if (!$reward) {

            return redirect()
                ->to('/user/reward')
                ->with('error', 'Data reward tidak ditemukan.');

        }

        return view('user/reward/show', [

            'title'         => 'Detail Reward',

            'pageTitle'     => 'Detail Reward',

            'pageSubtitle'  => 'Informasi penukaran voucher.',

            'reward'        => $reward,

        ]);
    }
}