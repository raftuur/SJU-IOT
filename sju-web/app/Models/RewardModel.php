<?php

namespace App\Models;

class RewardModel extends BaseModel
{
    protected $table = 'rewards';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'reward_name',

        'description',

        'image',

        'point_required',

        'stock',

        'status',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}