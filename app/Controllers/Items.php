<?php

namespace App\Controllers;

use App\Models\ModelItems;
use App\Models\ModelLog;
use CodeIgniter\Controller;

class Items extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new ModelItems(); // Initialize ModelItems
    }

    public function hapus($id)
    {
        // Perform delete action
        $this->model->delete($id);

        // Log the action
        $this->logAction('delete', $id);

        return redirect()->to('items');
    }

    public function edit($id)
    {
        // Perform edit action
        $item = $this->model->find($id);

        // Log the action
        $this->logAction('edit', $id);

        return json_encode($item);
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'item_name' => [
                'label' => 'Item Name',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'waktu' => [
                'label' => 'Waktu',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'price' => [
                'label' => 'Price',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            // Save action
            $item_id = $this->request->getPost('item_id');
            $item_name = $this->request->getPost('item_name');
            $waktu = $this->request->getPost('waktu');
            $category = $this->request->getPost('category');
            $description = $this->request->getPost('description');
            $price = $this->request->getPost('price');

            $data = [
                'item_id' => $item_id,
                'item_name' => $item_name,
                'waktu' => $waktu,
                'category' => $category,
                'description' => $description,
                'price' => $price
            ];

            $this->model->save($data);

            // Determine action message
            $actionMessage = ($item_id) ? 'edit item with id ' . $item_id : 'new item';

            // Log the action
            $this->logAction('save', $item_id, $actionMessage);

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
        $jumlahBaris = 5;
        $katakunci = $this->request->getGet('katakunci');
        if ($katakunci) {
            $pencarian = $this->model->cari($katakunci);
        } else {
            $pencarian = $this->model;
        }
        $data['katakunci'] = $katakunci;
        $data['dataItem'] = $pencarian->orderBy('item_id', 'desc')->findAll();
        $data['pager'] = $this->model->pager;
        $data['nomor'] = ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');
        return view('item_view', $data);
    }

    // Function to log actions
    protected function logAction($action, $item_id, $actionMessage = null)
    {
        $admin_id = session()->get('admin_id'); // Assuming admin_id is stored in session

        // Create log data
        $logData = [
            'admin_id' => $admin_id,
            'action' => ucfirst($action) . ' ' . ($actionMessage ?: 'table items with id ' . $item_id),
        ];

        // Save log using ModelLog
        $modelLog = new ModelLog();
        $modelLog->save($logData);
    }
}

