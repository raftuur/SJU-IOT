<?php

namespace App\Models;

class SensorLogModel extends BaseModel
{
    protected $table = 'sensor_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'machine_id',

        'weight',

        'bin_level',

        'temperature',

        'wifi_rssi',

        'voltage',

        'created_at',

    ];
}