<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLog extends Model
{
    protected $table = 'admin_log';
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['admin_id', 'action'];
}
