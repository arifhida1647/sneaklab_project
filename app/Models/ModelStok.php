<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStok extends Model
{
    protected $table = 'tb_stok';
    protected $primaryKey = 'id_stok ';
    protected $allowedFields = ['tipe', 'id_item', 'id_pemasok', 'jumlah','keterangan','id_user','updated_at'];

}
