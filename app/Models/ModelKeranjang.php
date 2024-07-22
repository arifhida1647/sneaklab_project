<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeranjang extends Model
{
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_penjualan', 'id_user', 'id_item', 'jumlah_item', 'harga_item', 'diskon_item', 'subtotal'];
}
