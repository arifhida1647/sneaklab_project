<?php

namespace App\Controllers;

use App\Models\ModelKategori;
use App\Models\ModelLog;
use CodeIgniter\Controller;

class Kategori extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new ModelKategori();
    }

    public function hapus($id)
    {
        // Perform delete action
        $this->model->delete($id);

        // Log the action
        // $this->logAction('delete', $id);

        return redirect()->to('kategori');
    }

    public function edit($id)
    {
        // Perform edit action
        $item = $this->model->find($id);

        // Log the action
        // $this->logAction('edit', $id);

        return json_encode($item);
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama_kategori' => [
                'label' => 'nama kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            // Save action
            $id = $this->request->getPost('id');
            $nama_kategori = $this->request->getPost('nama_kategori');

            $data = [
                'id' => $id,
                'nama_kategori' => $nama_kategori,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->model->save($data);

            // Determine action message
            // $actionMessage = ($item_id) ? 'edit item with id ' . $item_id : 'new item';

            // Log the action
            // $this->logAction('save', $item_id, $actionMessage);

            $hasil['sukses'] = "Berhasil memasukkan data";
            $hasil['error'] = false;
        } else {
            // Handle validation errors
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    public function index()
    {
        $data['dataKategori'] = $this->model->orderBy('id', 'desc')->findAll();
        return view('kategori_view', $data);
    }

    // // Function to log actions
    // protected function logAction($action, $item_id, $actionMessage = null)
    // {
    //     $admin_id = session()->get('admin_id'); // Assuming admin_id is stored in session

    //     // Create log data
    //     $logData = [
    //         'admin_id' => $admin_id,
    //         'action' => ucfirst($action) . ' ' . ($actionMessage ?: 'table items with id ' . $item_id),
    //     ];

    //     // Save log using ModelLog
    //     $modelLog = new ModelLog();
    //     $modelLog->save($logData);
    // }
}

