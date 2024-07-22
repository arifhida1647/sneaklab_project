<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUnit extends Model
{
    protected $table = "tb_unit";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama_unit','updated_at'];
}
