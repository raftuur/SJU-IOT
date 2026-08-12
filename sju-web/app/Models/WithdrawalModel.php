<?php

namespace App\Models;

class WithdrawalModel extends BaseModel
{
    protected $table = 'withdrawals';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'withdrawal_code',

        'user_id',

        'wallet_id',

        'point_used',

        'amount',

        'bank_code',

        'account_name',

        'account_number',

        'external_id',

        'xendit_disbursement_id',

        'reference_number',

        'status',

        'failure_reason',

        'requested_at',

        'processed_at',

        'completed_at',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}