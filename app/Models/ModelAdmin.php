<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    protected $table = "tb_users";
    protected $primaryKey = "id";
    protected $allowedFields = ['username','password','role'];
}
