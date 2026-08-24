<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'key',
        'value',
        'group',
        'description',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
}