<?php

namespace App\Controllers;

use App\Models\ModelStok;
use App\Models\ModelItem;
use App\Models\ModelPemasok;
use App\Models\ModelLog;
use CodeIgniter\Controller;

class Stokin extends Controller
{
    protected $modelStok;
    protected $modelItems;

    protected $modelPemasok;

    public function __construct()
    {
        $this->modelStok = new ModelStok();
        $this->modelItems = new ModelItem();
        $this->modelPemasok = new ModelPemasok();
    }

    public function hapus($id)
    {
        // Perform delete action
        $this->modelStok->delete($id);

        // Log the action
        // $this->logAction('delete', $id);

        return redirect()->to('stokin');
    }

    public function edit($id)
    {
        // Perform edit action
        $item = $this->modelStok->find($id);

        // Log the action
        // $this->logAction('edit', $id);

        return json_encode($item);
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'id_item' => [
                'label' => 'Item Harus Diisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'id_pemasok' => [
                'label' => 'Pemasok Harus Diisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'jumlah' => [
                'label' => 'Jumlah Harus Diisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'keterangan' => [
                'label' => 'Keterangan Harus Diisi',
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
            $id_stok = $this->request->getPost('id_stok');
            $id_item = $this->request->getPost('id_item');
            $id_pemasok = $this->request->getPost('id_pemasok');
            $jumlah = $this->request->getPost('jumlah');
            $keterangan = $this->request->getPost('keterangan');

            $data = [
                'id_stok' => $id_stok,
                'id_item' => $id_item,
                'id_pemasok' => $id_pemasok,
                'jumlah' => $jumlah,
                'keterangan' => $keterangan,
                'id_user' => session()->get('admin_id'),
                'tipe' => 'masuk',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->modelStok->save($data);

            // Update stock in ModelItems
            $item = $this->modelItems->find($id_item);
            if ($item) {
                $new_stok = $item['stok'] + $jumlah;
                $this->modelItems->update($id_item, ['stok' => $new_stok]);
            }

            // Determine action message
            // $actionMessage = ($id_item) ? 'edit item with id ' . $id_item : 'new item';

            // Log the action
            // $this->logAction('save', $id_item, $actionMessage);

            $hasil['sukses'] = "Berhasil memasukkan data dan mengupdate stok";
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
        // Join tabel stok, pemasok, dan items
        $data['dataStok'] = $this->modelStok
            ->select('tb_stok.*, tb_pemasok.nama_pemasok as nama_pemasok, tb_item.nama_item as nama_item, tb_users.username as username_user')
            ->join('tb_pemasok', 'tb_stok.id_pemasok = tb_pemasok.id')
            ->join('tb_item', 'tb_stok.id_item = tb_item.id')
            ->join('tb_users', 'tb_stok.id_user = tb_users.id')
            ->where('tb_stok.tipe', 'masuk')
            ->orderBy('tb_stok.id_stok', 'desc')
            ->findAll();

        $data['dataPemasok'] = $this->modelPemasok->orderBy('id', 'desc')->findAll();
        $data['dataItem'] = $this->modelItems->orderBy('id', 'desc')->findAll();
        return view('stokin_view', $data);
    }
}
