<?php

namespace App\Controllers;
use \App\Models\ModelPelanggan;
use App\Models\ModelLog;
class Pelanggan extends BaseController
{
	protected $model;
	function __construct()
	{
		$this->model = new ModelPelanggan();
	}
	public function hapus($id)
	{
		// $this->logAction('delete', $id);
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
            'nama_pelanggan' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter',
                ]
            ],
            'telp_pelanggan' => [
                'label' => 'telp_pelanggan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'alamat_pelanggan' => [
                'label' => 'Alamat Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            
        ];
		$validasi->setRules($aturan);
		if ($validasi->withRequest($this->request)->run()) {
			$id = $this->request->getPost('id');
			$nama_pelanggan = $this->request->getPost('nama_pelanggan');
			$telp_pelanggan = $this->request->getPost('telp_pelanggan');
			$alamat_pelanggan = $this->request->getPost('alamat_pelanggan');
			$data = [
				'id' => $id,
                'nama_pelanggan' => $nama_pelanggan,
                'telp_pelanggan' => $telp_pelanggan,
                'alamat_pelanggan' => $alamat_pelanggan,
                'updated_at' => date('Y-m-d H:i:s')
			];

			$this->model->save($data);

			// $actionMessage = ($id) ? 'edit Users with id ' . $id : 'New Users';

            // Log the action
            // $this->logAction('save', $user_id, $actionMessage);
			
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
		$data['dataUsers'] = $this->model->orderBy('id', 'desc')->findAll();
		return view('pelanggan_view', $data);
	}
	//  // Function to log actions
	//  protected function logAction($action, $item_id, $actionMessage = null)
	//  {
	// 	 $admin_id = session()->get('admin_id'); // Assuming admin_id is stored in session
 
	// 	 // Create log data
	// 	 $logData = [
	// 		 'admin_id' => $admin_id,
	// 		 'action' => ucfirst($action) . ' ' . ($actionMessage ?: 'table Users with id ' . $item_id),
	// 	 ];
 
	// 	 // Save log using ModelLog
	// 	 $modelLog = new ModelLog();
	// 	 $modelLog->save($logData);
	//  }
}
