<?php

namespace App\Controllers;

class Log extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelLog();
    }
    public function index()
    {
        
        $data['dataLog'] = $this->model->orderBy('created_at', 'desc')->findAll();
        
        return view('log_view', $data);
    }
}
