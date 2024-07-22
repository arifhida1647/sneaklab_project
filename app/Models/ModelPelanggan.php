<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    protected $table = "tb_pelanggan";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama_pelanggan', 'telp_pelanggan', 'alamat_pelanggan', 'updated_at'];

}
