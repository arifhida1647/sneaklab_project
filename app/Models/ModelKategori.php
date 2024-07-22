<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = "tb_kategori";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama_kategori','updated_at'];
}
