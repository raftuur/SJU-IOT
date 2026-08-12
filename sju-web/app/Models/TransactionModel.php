<?php

namespace App\Models;

class TransactionModel extends BaseModel
{
    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'transaction_code',

        'user_id',

        'machine_id',

        'machine_session_id',

        'ai_detection_id',

        'weight',

        'bottle_count',

        'point_earned',

        'detection_result',

        'confidence',

        'failure_reason',

        'processing_time',

        'status',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}