<?php

namespace App\Models;

class MachineModel extends BaseModel
{
    protected $table            = 'machines';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $protectFields    = true;

    protected $allowedFields = [

        'uuid',

        'machine_code',

        'machine_name',

        'location',

        'latitude',

        'longitude',

        'ip_address',

        'firmware_version',

        'status',

        'heartbeat_at',

        'last_online',

        'last_weight',

        'last_bin_level',

        'last_temperature',

        'last_wifi_rssi',

        'last_voltage',

        'deleted_at',

    ];
}