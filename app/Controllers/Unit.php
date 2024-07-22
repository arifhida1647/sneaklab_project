<?php

namespace App\Controllers;

use App\Models\ModelUnit;
use App\Models\ModelLog;
use CodeIgniter\Controller;

class Unit extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new ModelUnit();
    }

    public function hapus($id)
    {
        // Perform delete action
        $this->model->delete($id);

        // Log the action
        // $this->logAction('delete', $id);

        return redirect()->to('unit');
    }

    public function edit($id)
    {
        // Perform edit action
        $unit = $this->model->find($id);

        // Log the action
        // $this->logAction('edit', $id);

        return json_encode($unit);
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama_unit' => [
                'label' => 'nama unit',
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
            $nama_unit = $this->request->getPost('nama_unit');

            $data = [
                'id' => $id,
                'nama_unit' => $nama_unit,
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
        $data['dataUnit'] = $this->model->orderBy('id', 'desc')->findAll();
        return view('unit_view', $data);
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

