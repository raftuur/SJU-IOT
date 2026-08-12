<?php

namespace App\Models;

class AiDetectionModel extends BaseModel
{
    protected $table = 'ai_detections';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'detection_id',

        'bottle',

        'cap',

        'label',

        'confidence',

        'original_image',

        'detected_image',

        'json_result',

        'created_at',

        'updated_at',

        'deleted_at',

    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected array $casts = [];

    protected array $castHandlers = [];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $useSoftDeletes = false;

    protected $validationRules = [];

    protected $validationMessages = [];

    protected $skipValidation = false;

    protected $cleanValidationRules = true;
}