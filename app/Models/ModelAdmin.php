<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    protected $table = "admins";
    protected $primaryKey = "admin_id";
    protected $allowedFields = ['username', 'password','role'];
    function cari($katakunci)
    {
        //budi gmail
        $builder = $this->table("admins");
        $arr_katakunci = explode(" ", $katakunci);
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('username', $arr_katakunci[$x]);
        }
        return $builder;
    }
}
