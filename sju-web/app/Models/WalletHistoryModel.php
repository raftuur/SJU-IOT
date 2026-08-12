<?php

namespace App\Models;

class WalletHistoryModel extends BaseModel
{
    protected $table = 'wallet_histories';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'wallet_id',

        'transaction_id',

        'type',

        'point',

        'balance_before',

        'balance_after',

        'description',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}