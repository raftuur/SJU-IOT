<?php

namespace App\Models;

class RewardRedemptionModel extends BaseModel
{
    protected $table = 'reward_redemptions';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'redemption_code',

        'user_id',

        'wallet_id',

        'voucher_id',

        'point',

        'status',

        'redeemed_at',

        'completed_at',

        'notes',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}