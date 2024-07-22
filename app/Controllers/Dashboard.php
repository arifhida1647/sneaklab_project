<?php

namespace App\Controllers;

use App\Models\ModelKeranjang;
use App\Models\ModelPelanggan;
use App\Models\ModelInvoice;
use App\Models\ModelItem;

class Dashboard extends BaseController
{
    protected $model;
    protected $modelKeranjang;
    protected $modelPelanggan;
    protected $modelInvoice;
    public function __construct()
    {
        $this->model = new ModelInvoice();
        $this->modelKeranjang = new ModelKeranjang();
        $this->modelPelanggan = new ModelPelanggan();
        $this->modelItem = new ModelItem();
    }

    public function index(): string
    {
        // Mengambil 10 data teratas yang telah di-group dan dijumlahkan
        $data['dataInvoice'] = $this->model->select('tanggal, SUM(total_harga) as total_harga, SUM(tunai) as tunai, SUM(kembalian) as kembalian')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->where('status','sukses')
            ->limit(7)
            ->findAll();

        // Mengambil tanggal dan total_harga
        $labelsSales = [];
        $totalsSales = [];

        $labelsTunai = [];
        $totalsTunai = [];

        foreach ($data['dataInvoice'] as $invoice) {
            $labelsSales[] = $invoice['tanggal'];
            $totalsSales[] = $invoice['total_harga'];
        }
        foreach ($data['dataInvoice'] as $invoice) {
            $labelsTunai[] = $invoice['tanggal'];
            $totalsTunai[] = $invoice['tunai'];
        }
        // Menghitung jumlah data dengan status 'pending'
        $pendingCountQuery = $this->model->select('COUNT(*) as pendingCount')
            ->where('status', 'pending')
            ->first();
        $data['pendingCount'] = $pendingCountQuery['pendingCount'];

        $sumPenjualanQuery = $this->model->select('SUM(total_harga) as sumPenjualan')
            ->first();
        $data['sumPenjualan'] = $sumPenjualanQuery['sumPenjualan'];

        // Menghitung jumlah data dengan status 'sukses'
        $suksesCountQuery = $this->model->select('COUNT(*) as suksesCount')
            ->where('status', 'sukses')
            ->first();
        $data['suksesCount'] = $suksesCountQuery['suksesCount'];

        // Menghitung total data
        $totalCountQuery = $this->model->select('COUNT(*) as totalCount')
            ->first();
        $data['totalCount'] = $totalCountQuery['totalCount'];

        $pelangganCountQuery = $this->modelPelanggan->select('COUNT(*) as totalPelanggan')
            ->first();
        $data['totalPelanggan'] = $pelangganCountQuery['totalPelanggan'];

        $itemCountQuery = $this->modelItem->select('COUNT(*) as totalItem')
            ->first();
        $data['totalItem'] = $itemCountQuery['totalItem'];


        // Menambahkan labels dan totals ke dalam data
        $data['labelsSales'] = $labelsSales;
        $data['totalsSales'] = $totalsSales;
        // Menambahkan labels dan totals ke dalam data
        $data['labelsTunai'] = $labelsTunai;
        $data['totalsTunai'] = $totalsTunai;
        return view('dashboard_view', $data);
    }
}