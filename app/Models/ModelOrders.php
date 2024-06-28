<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelOrders extends Model
{
    protected $table = "orders";
    protected $primaryKey = "order_id";
    protected $allowedFields = ['user_id', 'order_date', 'status', 'total_amount','payment_proof_path'];

    function cari($katakunci)
    {
        //budi gmail
        $builder = $this->table("orders");
        $arr_katakunci = explode(" ", $katakunci);
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('user_id', $arr_katakunci[$x]);
            $builder->orLike('order_date', $arr_katakunci[$x]);
            $builder->orLike('total_amount', $arr_katakunci[$x]);            
            $builder->orLike('status', $arr_katakunci[$x]);      
            
        }
        return $builder;
    }
}
