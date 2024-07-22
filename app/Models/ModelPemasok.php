<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPemasok extends Model
{
    protected $table = "tb_pemasok";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama_pemasok','telp_pemasok','alamat_pemasok','keterangan'];
}
