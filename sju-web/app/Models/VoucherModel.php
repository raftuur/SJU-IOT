<?php

namespace App\Models;

class VoucherModel extends BaseModel
{
    protected $table = 'vouchers';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'code',

        'title',

        'description',

        'image',

        'point',

        'stock',

        'redeemed',

        'start_date',

        'end_date',

        'status',

        'created_at',

        'updated_at',

        'deleted_at',

    ];
}