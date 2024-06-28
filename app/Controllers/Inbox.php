<?php

namespace App\Controllers;

use App\Models\ModelInbox;

class Inbox extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ModelInbox();
    }

    public function index()
    {
        $data['inboxData'] = $this->model->orderBy('inbox_id', 'desc')->findAll();
        return view('inbox_view', $data);
    }
}
