<?php

namespace App\Repositories;

use App\Models\RewardRedemptionModel;

class RewardRedemptionRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new RewardRedemptionModel();
    }

    /**
     * Semua redemption beserta user dan voucher
     */
    public function findAllWithRelation(string $keyword = '')
    {
        $builder = $this->model
            ->select('
                reward_redemptions.*,
                users.fullname,
                users.email,
                vouchers.title AS voucher_title,
                vouchers.point
            ')
            ->join('users', 'users.id = reward_redemptions.user_id')
            ->join('vouchers', 'vouchers.id = reward_redemptions.voucher_id');

        if (!empty($keyword)) {

            $builder->groupStart()
                ->like('reward_redemptions.redemption_code', $keyword)
                ->orLike('users.fullname', $keyword)
                ->orLike('vouchers.title', $keyword)
                ->groupEnd();

        }

        return $builder
            ->orderBy('reward_redemptions.id', 'DESC')
            ->findAll();
    }

    /**
     * Detail redemption berdasarkan ID
     */
    public function getDetail(int $id): ?array
    {
        return $this->model
            ->select('
                reward_redemptions.*,
                users.fullname AS fullname,
                users.email AS email,
                vouchers.title AS voucher_title,
                vouchers.code AS voucher_code,
                vouchers.image AS voucher_image
            ')
            ->join('users', 'users.id = reward_redemptions.user_id')
            ->join('vouchers', 'vouchers.id = reward_redemptions.voucher_id')
            ->where('reward_redemptions.id', $id)
            ->first();
    }

    /**
     * Membuat redemption baru
     */
    public function create(array $data): ?array
    {
        $this->model->insert($data);

        return $this->model
            ->find($this->model->getInsertID());
    }

    /**
     * Approve redemption
     */
    public function approve(int $id): bool
    {
        $db = db_connect();

        $db->transStart();

        // Ambil data redemption
        $redemption = $this->model->find($id);

        if (!$redemption) {
            return false;
        }

        // Kurangi stok voucher dan tambah redeemed
        $db->table('vouchers')
            ->where('id', $redemption['voucher_id'])
            ->set('stock', 'stock - 1', false)
            ->set('redeemed', 'redeemed + 1', false)
            ->update();

        // Update status redemption
        $this->model->update($id, [
            'status'       => 'completed',
            'completed_at' => date('Y-m-d H:i:s'),
        ]);

        $db->transComplete();

        return $db->transStatus();
    }

    /**
     * Reject redemption
     */
    public function reject(int $id): bool
    {
        return $this->model
            ->where('id', $id)
            ->set([
                'status'       => 'rejected',
                'completed_at' => date('Y-m-d H:i:s'),
            ])
            ->update();
    }
}