<?php

namespace App\Controllers;

use App\Models\ModelInvoice;
use App\Models\ModelItem;
use App\Models\ModelAdmin;
use App\Models\ModelKeranjang;
use App\Models\ModelPelanggan;
use App\Models\ModelLog;
use CodeIgniter\Controller;

class Keranjang extends Controller
{
    protected $model;
    protected $modelItem;
    protected $modelUser;
    protected $modelPelanggan;

    protected $modelInvoice;
    public function __construct()
    {
        $this->modelInvoice = new ModelInvoice();
        $this->model = new ModelKeranjang();
        $this->modelItem = new ModelItem();
        $this->modelUser = new ModelAdmin();
        $this->modelPelanggan = new ModelPelanggan();
    }

    public function hapus($id)
    {
        $id_item = $this->model
            ->where('id_transaksi', $id)
            ->first()['id_item'];

        $stok_item = $this->modelItem
            ->where('id', $id_item)
            ->first()['stok'];

        $jumlah_item = $this->model
            ->where('id_item', $id_item)
            ->first()['jumlah_item'];
        $stok_baru = $jumlah_item + $stok_item;

        $this->modelItem->update($id_item, ['stok' => $stok_baru]);
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
            'id_penjualan' => [
                'label' => 'id_penjualan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'id_item' => [
                'label' => 'id_item',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'jumlah_item' => [
                'label' => 'jumlah_item',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            // Save action
            $id_transaksi = $this->request->getPost('id_transaksi');
            $id_penjualan = $this->request->getPost('id_penjualan');
            $id_item = $this->request->getPost('id_item');
            $id_user = $this->modelUser
                ->where('id', session()->get('admin_id'))
                ->first()['id'];
            $harga_item = $this->modelItem
                ->where('id', $id_item)
                ->first()['harga'];
            $jumlah_item = $this->request->getPost('jumlah_item');
            $diskon_item = $this->request->getPost('diskon_item'); // default 0 if not provided
            $subtotal = $harga_item * $jumlah_item;

            $stok_item = $this->modelItem
                ->where('id', $id_item)
                ->first()['stok'];

            // Cek apakah jumlah_item tidak lebih besar dari stok
            if ($jumlah_item > $stok_item) {
                $hasil['sukses'] = false;
                $hasil['error'] = "Stok tersedia : " . $stok_item;
            } else {
                $subtotal = $harga_item * $jumlah_item;

                $data = [
                    'id_transaksi' => $id_transaksi,
                    'id_penjualan' => $id_penjualan,
                    'id_user' => $id_user,
                    'id_item' => $id_item,
                    'jumlah_item' => $jumlah_item,
                    'harga_item' => $harga_item,
                    'subtotal' => $subtotal,
                    'diskon_item' => $diskon_item,
                ];

                $this->model->save($data);

                $stok_baru = $stok_item - $jumlah_item;
                $this->modelItem->update($id_item, ['stok' => $stok_baru]);

                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['error'] = false;
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }
        return json_encode($hasil);
    }

    public function index()
    {
        $admin_id = session()->get('admin_id');

        // Mengambil data keranjang berdasarkan id_user
        $data['dataKeranjang'] = $this->model
            ->select('tb_transaksi.*, tb_item.nama_item as item_name, tb_item.harga as item_price')
            ->join('tb_item', 'tb_transaksi.id_item = tb_item.id')
            ->where('id_user', $admin_id)
            ->orderBy('id_transaksi', 'desc')
            ->findAll();

        // Mengambil total subtotal berdasarkan id_user
        $data['totalSubtotal'] = $this->model->select('id_user, SUM(subtotal) as totalSubtotal')
            ->where('id_user', $admin_id)
            ->groupBy('id_user')
            ->findAll();

        // Mengambil data item, user, pelanggan
        $data['dataItem'] = $this->modelItem
            ->where('stok >', 0)
            ->findAll();
        $data['dataUser'] = $this->modelUser->findAll();
        $data['dataPelanggan'] = $this->modelPelanggan->findAll();

        // Mengambil data invoice berdasarkan id_user dan status
        $data['dataInvoice'] = $this->modelInvoice
            ->select('tb_penjualan.*, tb_users.username as user_name, tb_pelanggan.nama_pelanggan as pelanggan_name')
            ->join('tb_users', 'tb_penjualan.id_user = tb_users.id')
            ->join('tb_pelanggan', 'tb_penjualan.id_pelanggan = tb_pelanggan.id')
            ->where('tb_penjualan.id_user', $admin_id)
            ->where('tb_penjualan.status', 'pending')
            ->findAll();

        // Memeriksa apakah ada data invoice
        if (!empty($data['dataInvoice'])) {
            $id_penjualan = $data['dataInvoice'][0]['id'];
            // Mengambil total subtotal berdasarkan id_penjualan
            $data['totalSubtotalByPenjualan'] = $this->model->select('SUM(subtotal) as totalSubtotal')
                ->where('id_penjualan', $id_penjualan)
                ->first();
        } else {
            $data['totalSubtotalByPenjualan'] = ['totalSubtotal' => 0];
        }

        return view('keranjang_view', $data);
    }
}

