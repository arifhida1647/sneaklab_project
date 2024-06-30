<?php

namespace App\Controllers;

use App\Models\ModelLog;

class admin extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelAdmin();
    }
    public function hapus($id)
    {
        $this->logAction('delete', $id);
        $this->model->delete($id);
        return redirect()->to('admin');
    }
    public function edit($id)
    {
        return json_encode($this->model->find($id));
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 8 karakter'
                ]
            ],
            'role' => [
                'label' => 'role',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $admin_id = $this->request->getPost('admin_id');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $role = $this->request->getPost('role');

            $data = [
                'admin_id' => $admin_id,
                'username' => $username,
                'password' => $password,
                'role' => $role,
            ];

            $this->model->save($data);

            $actionMessage = ($admin_id) ? 'edit Admin with id ' . $admin_id : 'New Admin';

            // Log the action
            $this->logAction('save', $admin_id, $actionMessage);

            $hasil['sukses'] = "Berhasil memasukkan data";
            $hasil['error'] = true;
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }


        return json_encode($hasil);
    }
    public function index()
    {
        $data['dataAdmin'] = $this->model->orderBy('admin_id', 'desc')->findAll();
        return view('admin_view', $data);
    }
    // Function to log actions
    protected function logAction($action, $item_id, $actionMessage = null)
    {
        $admin_id = session()->get('admin_id'); // Assuming admin_id is stored in session

        // Create log data
        $logData = [
            'admin_id' => $admin_id,
            'action' => ucfirst($action) . ' ' . ($actionMessage ?: 'table Admin with id ' . $item_id),
        ];

        // Save log using ModelLog
        $modelLog = new ModelLog();
        $modelLog->save($logData);
    }
}
