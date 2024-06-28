<?php

namespace App\Controllers;

use App\Models\ModelLog;

class Orders extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelOrders();
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        $this->logAction('delete', $id);
        return redirect()->to('orders');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return json_encode($item);

    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'user_id' => [
                'label' => 'User ID',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'total_amount' => [
                'label' => 'Total Amount',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $order_id = $this->request->getPost('order_id');
            $user_id = $this->request->getPost('user_id');
            $status = $this->request->getPost('status');
            $total_amount = $this->request->getPost('total_amount');
            $payment_proof_path = $this->request->getPost('payment_proof_path');

            $data = [
                'order_id' => $order_id,
                'user_id' => $user_id,
                'status' => $status,
                'total_amount' => $total_amount,
                'payment_proof_path' => $payment_proof_path
            ];

            $this->model->save($data);

            // Determine action message
            $actionMessage = ($order_id) ? 'edit Orders with id ' . $order_id : 'New Orders';

            // Log the action
            $this->logAction('save', $order_id, $actionMessage);

            $hasil['sukses'] = "Berhasil memasukkan data";
            $hasil['error'] = false;
        } else {
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
        $data['dataOrders'] = $pencarian->orderBy('order_id', 'desc')->findAll();
        $data['pager'] = $this->model->pager;
        $data['nomor'] = ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');
        return view('orders_view', $data);
    }
    // Function to log actions
    // Function to log actions
    protected function logAction($action, $item_id, $actionMessage = null)
    {
        $admin_id = session()->get('admin_id'); // Assuming admin_id is stored in session

        // Create log data
        $logData = [
            'admin_id' => $admin_id,
            'action' => ucfirst($action) . ' ' . ($actionMessage ?: 'table orders with id ' . $item_id),
        ];

        // Save log using ModelLog
        $modelLog = new ModelLog();
        $modelLog->save($logData);
    }
}
