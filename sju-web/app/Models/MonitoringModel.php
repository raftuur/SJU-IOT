<?php

namespace App\Models;

class MonitoringModel extends BaseModel
{
    protected $table = 'machines';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'machine_code',
        'machine_name',
        'location',
        'status',
        'last_online',
        'firmware_version',
        'ip_address',
        'latitude',
        'longitude'
    ];
}