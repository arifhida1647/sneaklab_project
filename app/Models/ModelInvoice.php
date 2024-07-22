<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInvoice extends Model
{
    protected $table = 'tb_penjualan';
    protected $primaryKey ='id';
    protected $allowedFields = ['id_pelanggan', 'total_harga','tunai','kembalian','catatan','tanggal','id_user','status'];

}
