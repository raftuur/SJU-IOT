<?php

namespace App\Models;

class MachineSessionModel extends BaseModel
{
    protected $table = 'machine_sessions';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'machine_id',

        'user_id',

        'transaction_id',

        'session_token',

        'status',

        'total_bottle',

        'total_weight',

        'total_point',

        'started_at',

        'completed_at',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}