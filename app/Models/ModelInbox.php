<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInbox extends Model
{
    protected $table = 'inbox';
    protected $primaryKey = 'inbox_id';
    protected $allowedFields = ['email', 'name', 'pesan','pesan','subject'];
}
