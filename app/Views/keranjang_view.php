<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Toko sembako Leon | Data Keranjang</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php echo view('sidebar'); ?>

        <!-- CONTAINER -->
        <div class="content-wrapper">
            <!-- if -->
            <?php if (empty($dataInvoice[0]['id'])): ?>
                <div class="card card-primary mx-3 my-3">
                    <div class="card-header" style="background-color: #FF8225">
                        <h3 class="card-title">Buat Keranjang</h3>
                    </div>

                    <input type="hidden" id="inputId" name="id">
                    <div class="card-body">
                        <div class="alert alert-danger error" role="alert" style="display: none;"></div>
                        <div class="alert alert-primary sukses" role="alert" style="display: none;"></div>
                        <div class="form-group">
                            <input type="hidden" class="form-control form-control-border" name="id_user" id="generateUser"
                                value="<?= session()->get('admin_id') ?>">
                        </div>
                        <div class="form-group">
                            <label for="generatePelanggan">Pelanggan</label>
                            <select id="generatePelanggan" class="form-select" name="id_pelanggan">
                                <?php
                                $nomor = 0;
                                foreach ($dataPelanggan as $k => $v) {
                                    ?>
                                    <option value=<?= $v['id'] ?>><?= $v['nama_pelanggan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <a href="<?php echo base_url('pelanggan') ?>"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Tambah Pelanggan</button></a>
                        <button type="button" class="btn btn-primary" id="tombolGenerate">Buat</button>
                    </div>
                </div>
            <?php else: ?>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Item</h5>
                                <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- ERROR AND SUCCESS ALERTS -->
                                <div class="alert alert-danger error" role="alert" style="display: none;"></div>
                                <div class="alert alert-primary sukses" role="alert" style="display: none;"></div>
                                <!-- FORM INPUT DATA -->
                                <input type="hidden" id="inputId" name="id_transaksi">
                                <input type="hidden" id="inputPenjualan" name="id_penjualan"
                                    value="<?= $dataInvoice[0]['id'] ?>">
                                <div class="mb-3 row">
                                    <label for="inputItem" class="col-sm-2 col-form-label">Item</label>
                                    <div class="col-sm-10">
                                        <select id="inputItem" class="form-select" name="id_item">
                                            <?php
                                            $nomor = 0;
                                            foreach ($dataItem as $k => $v) {
                                                ?>
                                                <option value=<?= $v['id'] ?>><?= $v['nama_item'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputJumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputJumlah" name="jumlah_item">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputDiskon" class="col-sm-2 col-form-label">Diskon</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputDiskon" name="diskon_item">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup
                                </button>
                                <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-2">
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">TOTAL</h3>
                            </div>

                            <div class="card-body">
                                <?= $totalSubtotalByPenjualan['totalSubtotal'] ?? '0' ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">USER</h3>
                            </div>

                            <div class="card-body">
                                <?= $dataInvoice[0]['user_name'] ?? 'No Invoice Available' ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">PELANGGAN</h3>
                            </div>

                            <div class="card-body">
                                <?= $dataInvoice[0]['pelanggan_name'] ?? 'No Invoice Available' ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">INVOICE</h3>
                            </div>
                            <div class="card-body">
                               #<?= $dataInvoice[0]['id'] ?? 'No Invoice Available' ?>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-info btn-sm my-3 py-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        + Tambah Data Item
                    </button>
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>item </th>
                                <th>harga item</th>
                                <th>jumlah item</th>
                                <th>diskon item</th>
                                <th>subtotal</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 0;
                            foreach ($dataKeranjang as $k => $v) {
                                if ($v['id_penjualan'] == $dataInvoice[0]['id']) {
                                    ?>
                                    <tr>
                                        <td><?= ++$nomor ?></td>
                                        <td><?= $v['id_transaksi'] ?></td>
                                        <td><?= $v['item_name'] ?></td>
                                        <td>Rp <?= $v['item_price'] ?></td>
                                        <td><?= $v['jumlah_item'] ?></td>
                                        <td><?= $v['diskon_item'] ?></td>
                                        <td>Rp <?= ($v['harga_item'] * $v['jumlah_item']) - $v['diskon_item'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="hapus(<?php echo $v['id_transaksi'] ?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card card-primary mx-3">
                    <div class="card-header">
                        <h3 class="card-title">Chekout</h3>
                    </div>
                    <div class="alert alert-danger errorPayment mx-2 my-2" role="alert" style="display: none;"></div>
                    <div class="alert alert-primary suksesPayment mx-2 my-2" role="alert" style="display: none;"></div>
                    <input type="hidden" name="id" id="penjualan" value="<?= $dataInvoice[0]['id'] ?>">
                    <input type="hidden" name="id_user" id="user" value="<?= $dataInvoice[0]['id_user'] ?>">
                    <input type="hidden" name="id_pelanggan" id="pelanggan" value="<?= $dataInvoice[0]['id_pelanggan'] ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputBorder">Tunai</label>
                            <input type="text" class="form-control form-control-border" id="tunai" placeholder="Tunai">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputRounded0">Note</label>
                            <input type="text" class="form-control rounded-0" id="note">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputRounded0">Total</label>
                            <input type="number" class="form-control rounded-0" id="total"
                                value="<?= $totalSubtotalByPenjualan['totalSubtotal'] ?? '0' ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Kembalian</label>
                            <input type="text" class="form-control form-control-border border-width-2" id="kembalian"
                                disabled>
                        </div>
                        <button type="button" class="btn btn-danger tombol-tutup" data-bs-dismiss="modal"
                            onclick="hapusInvoice(<?php echo $dataInvoice[0]['id'] ?>)">Hapus Keranjang
                        </button>
                        <button type="button" class="btn btn-primary" id="tombolPay">Pay</button>
                    </div>

                </div>
            <?php endif; ?>
        </div>

        <?php echo view('footer'); ?>
    </div>
    <!-- logic kembalian -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tunaiInput = document.getElementById('tunai');
            const totalInput = document.getElementById('total');
            const kembalianInput = document.getElementById('kembalian');

            function updateKembalian() {
                const tunai = parseFloat(tunaiInput.value) || 0;
                const total = parseFloat(totalInput.value) || 0;
                const kembalian = tunai - total;
                kembalianInput.value = kembalian;
            }

            tunaiInput.addEventListener('input', updateKembalian);
            totalInput.addEventListener('change', updateKembalian);
        });
    </script>
    <!-- keranjang -->
    <script>
        function hapus(id_transaksi) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?= site_url('keranjang/hapus') ?>/" + id_transaksi;
            }
        }

        function edit($id_transaksi) {
            $.ajax({
                url: "<?= site_url('keranjang/edit') ?>/" + $id_transaksi,
                type: "get",
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.id_transaksi !== '') {
                        $('#inputId').val(obj.id_transaksi);
                        $('#inputPenjualan').val(obj.id_penjualan);
                        $('#inputItem').val(obj.id_item);
                        $('#inputJumlah').val(obj.jumlah_item);
                        $('#inputDiskon').val(obj.diskon_item);

                    }
                }
            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputPenjualan').val('');
            $('#inputItem').val('');
            $('#inputJumlah').val('');
            $('#inputDiskon').val('');

        }

        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?= current_url() . '?' . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function () {
            var id_transaksi = $('#inputId').val();
            var id_penjualan = $('#inputPenjualan').val();
            var id_item = $('#inputItem').val();
            var jumlah_item = $('#inputJumlah').val();
            var diskon_item = $('#inputDiskon').val();

            $.ajax({
                url: "<?= site_url('keranjang/simpan') ?>",
                type: "POST",
                data: {
                    id_transaksi: id_transaksi,
                    id_penjualan: id_penjualan,
                    id_item: id_item,
                    jumlah_item: jumlah_item,
                    diskon_item: diskon_item
                },
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.sukses === false) {
                        $('.sukses').hide();
                        $('.error').show();
                        $('.error').html(obj.error);
                    } else {
                        $('.error').hide();
                        $('.sukses').show();
                        $('.sukses').html(obj.sukses);
                        bersihkan();
                    }
                }
            });
        });
    </script>
    <!-- Payment -->
    <script>
        function hapusInvoice(id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?= site_url('invoice/hapus') ?>/" + id;
            }
        }
        function bersihkan() {
            $('#tunai').val('');
            $('#note').val('');
        }

        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?= current_url() . '?' . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolPay').on('click', function () {
            var id_penjualan = $('#penjualan').val();
            var id_pelanggan = $('#pelanggan').val();
            var id_user = $('#user').val();
            var tunai = $('#tunai').val();
            var catatan = $('#note').val();
            var total_harga = $('#total').val();
            var kembalian = $('#kembalian').val();

            if (tunai.trim() === '') {
                $('.errorPayment').html('Tunai harus diisi.');
                $('.errorPayment').show();
                return; // Berhenti eksekusi jika validasi gagal
            }
            if (kembalian < 0) {
                $('.errorPayment').html('Dana tidak cukup.');
                $('.errorPayment').show();
                return; // Berhenti eksekusi jika validasi gagal
            }
            $.ajax({
                url: "<?= site_url('invoice/simpan') ?>",
                type: "POST",
                data: {
                    id: id_penjualan,
                    id_pelanggan: id_pelanggan,
                    id_user: id_user,
                    tunai: tunai,
                    catatan: catatan,
                    total_harga: total_harga,
                    kembalian: kembalian
                },
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.sukses === false) {
                        $('.suksesPayment').hide();
                        $('.errorPayment').show();
                        $('.errorPayment').html(obj.error);
                    } else {
                        $('.errorPayment').hide();
                        $('.suksesPayment').show();
                        $('.suksesPayment').html(obj.sukses);
                        bersihkan();
                        location.reload();
                    }
                }
            });
        });
    </script>
    <!-- generate -->
    <script>
        function bersihkan() {
            $('#generatePelanggan').val('');
        }

        $('#tombolGenerate').on('click', function () {
            var id = $('#inputId').val();
            var id_pelanggan = $('#generatePelanggan').val();
            var id_user = $('#generateUser').val();

            $.ajax({
                url: "<?= site_url('invoice/generate') ?>",
                type: "POST",
                data: {
                    id: id,
                    id_pelanggan: id_pelanggan,
                    id_user: id_user,
                },
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.sukses === false) {
                        $('.sukses').hide();
                        $('.error').show();
                        $('.error').html(obj.error);
                    } else {
                        $('.error').hide();
                        $('.sukses').show();
                        $('.sukses').html(obj.sukses);
                        bersihkan();
                        location.reload();
                    }
                }
            });
        });
    </script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

</body>

</html>