<?php

namespace App\Controllers;

use App\Models\ModelInvoice;
use App\Models\ModelKeranjang;
use App\Models\ModelAdmin;
use App\Models\ModelLog;
use CodeIgniter\Controller;

class Invoice extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new ModelInvoice();
        $this->modelKeranjang = new ModelKeranjang();
        $this->modelAdmin = new ModelAdmin();
    }

    public function hapus($id)
    {
        // Perform delete action
        $this->model->delete($id);

        // Log the action
        // $this->logAction('delete', $id);

        return redirect()->to('keranjang');
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
            'id_pelanggan' => [
                'label' => 'pelanggan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'id_user' => [
                'label' => 'user',
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
            $id_pelanggan = $this->request->getPost('id_pelanggan');
            $total_harga = $this->request->getPost('total_harga');
            $id_user = $this->request->getPost('id_user');
            $tunai = $this->request->getPost('tunai');
            $kembalian = $this->request->getPost('kembalian');
            $catatan = $this->request->getPost('catatan');

            $data = [
                'id' => $id,
                'id_pelanggan' => $id_pelanggan,
                'id_user' => $id_user,
                'tunai' => $tunai,
                'total_harga' => $total_harga,
                'kembalian' => $kembalian,
                'catatan' => $catatan,
                'status' => 'sukses',
                'tanggal' => date('Y-m-d H:i:s')
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
    public function generate()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'id_pelanggan' => [
                'label' => 'pelanggan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'id_user' => [
                'label' => 'user',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            // Save action
            $id = $this->request->getPost('id');
            $id_pelanggan = $this->request->getPost('id_pelanggan');
            $id_user = $this->request->getPost('id_user');

            $data = [
                'id' => $id,
                'id_pelanggan' => $id_pelanggan,
                'id_user' => $id_user,
                'status' => 'pending',
                'tanggal' => date('Y-m-d H:i:s')
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
        $data['dataInvoice'] = $this->model->select('tb_penjualan.*, tb_pelanggan.nama_pelanggan, tb_users.username')
            ->join('tb_pelanggan', 'tb_penjualan.id_pelanggan = tb_pelanggan.id')
            ->join('tb_users','tb_penjualan.id_user = tb_users.id')
            ->findAll();
        return view('penjualan_view', $data);
    }
    public function detail($id)
    {
        $data['data'] = $this->model->where('id', $id)
            ->findAll();
        $data['transaksi'] = $this->modelKeranjang->select('tb_transaksi.*, tb_item.nama_item, tb_item.harga')
            ->join('tb_item', 'tb_transaksi.id_item = tb_item.id')
            ->where('tb_transaksi.id_penjualan', $id)
            ->findAll();

        return view('invoice_view', $data);
        ;
    }

}

