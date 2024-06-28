<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelItems extends Model
{
    protected $table = 'laundry_items';
    protected $primaryKey = 'item_id';
    protected $allowedFields = ['item_name', 'waktu', 'category', 'description', 'price'];

    function cari($katakunci)
    {
        $builder = $this->table("laundry_items");
        $arr_katakunci = explode(" ", $katakunci);
        foreach ($arr_katakunci as $keyword) {
            $builder->orLike('item_name', $keyword);
            $builder->orLike('waktu', $keyword);
            $builder->orLike('category', $keyword);
            $builder->orLike('description', $keyword);
            $builder->orLike('price', $keyword);
        }
        return $builder;
    }
}
