<?php

namespace App\Controllers;

use App\Models\ModelItems;

class Logout extends BaseController
{
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
