<?php

namespace App\Models;

class MachineLogModel extends BaseModel
{
    protected $table = 'machine_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'machine_id',

        'activity',

        'description',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}