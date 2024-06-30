<?php

namespace App\Controllers;

use App\Models\ModelLog;
class Users extends BaseController
{
	function __construct()
	{
		$this->model = new \App\Models\ModelUsers();
	}
	public function hapus($id)
	{
		$this->logAction('delete', $id);
		$this->model->delete($id);
		return redirect()->to('users');
	}
	public function edit($id)
	{
		return json_encode($this->model->find($id));
	}

	public function simpan()
	{
		$validasi  = \Config\Services::validation();
		$aturan = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[5]||is_unique[users.username]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter',
					'is_unique' => 'This username is already registered.'
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
            'full_name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'Email yang Anda masukkan tidak valid',
					'is_unique' => 'This email is already registered.'
                ]
            ],
            'phone_number' => [
                'label' => 'Nomor Telepon',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 10 karakter'
                ]
            ],
            'address' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 10 karakter'
                ]
            ],
        ];
		$validasi->setRules($aturan);
		if ($validasi->withRequest($this->request)->run()) {
			$user_id = $this->request->getPost('user_id');
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$full_name = $this->request->getPost('full_name');
			$email = $this->request->getPost('email');
            $phone_number = $this->request->getPost('phone_number');
            $address = $this->request->getPost('address');
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$data = [
				'user_id' => $user_id,
				'username' => $username,
				'password' => $hashed_password,
				'full_name' => $full_name,
				'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
			];

			$this->model->save($data);

			$actionMessage = ($user_id) ? 'edit Users with id ' . $user_id : 'New Users';

            // Log the action
            $this->logAction('save', $user_id, $actionMessage);
			
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
		$data['dataUsers'] = $this->model->orderBy('user_id', 'desc')->findAll();
		return view('users_view', $data);
	}
	 // Function to log actions
	 protected function logAction($action, $item_id, $actionMessage = null)
	 {
		 $admin_id = session()->get('admin_id'); // Assuming admin_id is stored in session
 
		 // Create log data
		 $logData = [
			 'admin_id' => $admin_id,
			 'action' => ucfirst($action) . ' ' . ($actionMessage ?: 'table Users with id ' . $item_id),
		 ];
 
		 // Save log using ModelLog
		 $modelLog = new ModelLog();
		 $modelLog->save($logData);
	 }
}
