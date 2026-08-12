<?php

namespace App\Models;

class UserModel extends BaseModel
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [

        'uuid',

        'fullname',

        'username',

        'email',

        'phone',

        'password',

        'login_provider',

        'google_id',

        'avatar',

        'role',

        'status',

        'qr_code',

        'email_verified_at',

        'last_login_at',

        'created_at',

        'updated_at',

        'deleted_at',

    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected array $casts = [];

    protected array $castHandlers = [];

    protected $validationRules = [];

    protected $validationMessages = [];

    protected $skipValidation = false;

    protected $cleanValidationRules = true;
}