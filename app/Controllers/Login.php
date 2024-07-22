<?php

namespace App\Controllers;

use App\Models\ModelAdmin;

class Login extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ModelAdmin();
    }

    public function index()
    {
        $member_username = $this->request->getPost('member_username');
        $member_password = $this->request->getPost('member_password');
        $err = null; // Initialize error variable

        if ($this->request->getPost('login')) { // Check if form is submitted
            if (empty($member_username) || empty($member_password)) {
                $err = "Silahkan masukan username dan password";
            } else {
                // Find user by username
                $dataUser = $this->model->where('username', $member_username)->first();

                if (!$dataUser) {
                    $err = "Username tidak ditemukan";
                } else {
                    // Verify password
                    if ($member_password != $dataUser['password']) {
                        $err = "Password salah";
                    }
                }

                // If no error, set session and redirect to home
                if (empty($err)) {
                    $dataSesi = [
                        'admin_id' => $dataUser['id'],
                        'role' => $dataUser['role']
                    ];
                    session()->set($dataSesi);
                    return redirect()->to(base_url());
                }
            }

            // Set flashdata for error and username
            session()->setFlashdata('member_username', $member_username);
            session()->setFlashdata('error', $err);
            return redirect()->to(base_url('login'));
        }

        return view('login_view');
    }
}
