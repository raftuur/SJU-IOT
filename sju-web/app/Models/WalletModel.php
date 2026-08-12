<?php

namespace App\Models;

class WalletModel extends BaseModel
{
    protected $table = 'wallets';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'user_id',

        'balance',

        'total_earned',

        'total_redeemed',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}