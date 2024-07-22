<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Toko sembako Leon | Data Kategori</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php echo view('sidebar'); ?>

        <!-- CONTAINER -->
        <div class="content-wrapper">
            <!-- CARD -->
            <div class="card">
                <div class="card-body">

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
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
                                    <input type="hidden" id="inputId" name="id_stok">
                                    <div class="mb-3 row">
                                        <label for="inputItem" class="col-sm-2 col-form-label">Unit</label>
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
                                        <label for="inputPemasok" class="col-sm-2 col-form-label">Unit</label>
                                        <div class="col-sm-10">
                                            <select id="inputPemasok" class="form-select" name="id_pemasok">
                                                <?php
                                                $nomor = 0;
                                                foreach ($dataPemasok as $k => $v) {
                                                    ?>
                                                    <option value=<?= $v['id'] ?>><?= $v['nama_pemasok'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputJumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputJumlah" name="jumlah">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputKeterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputKeterangan"
                                                name="keterangan">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup"
                                        data-bs-dismiss="modal">Tutup
                                    </button>
                                    <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- TABLE OF ITEMS -->
                    <div class="card">
                        <div class="card-header py-3 text-white" style="background-color: #FF8225">
                            <h3 class="card-title">Data Stok In</h3>
                        </div>
                        <button type="button" class="btn btn-info btn-sm my-3 py-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            + Tambah Data Stok In
                        </button>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>id</th>
                                        <th>Item</th>
                                        <th>tipe</th>
                                        <th>Pemasok</th>
                                        <th>Jumlah</th>
                                        <th>User</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Perubahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 0;
                                    foreach ($dataStok as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?= ++$nomor ?></td>
                                            <td><?= $v['id_stok'] ?></td>
                                            <td><?= $v['nama_item'] ?></td>
                                            <td><?= $v['tipe'] ?></td>
                                            <td><?= $v['nama_pemasok'] ?></td>
                                            <td><?= $v['jumlah'] ?></td>
                                            <td><?= $v['username_user'] ?></td>
                                            <td><?= $v['keterangan'] ?></td>
                                            <td><?= $v['updated_at'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Button trigger modal -->

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>

        <?php echo view('footer'); ?>
    </div>

    <script>
        function hapus(id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?= site_url('stokin/hapus') ?>/" + id;
            }
        }

        function edit($id) {
            $.ajax({
                url: "<?= site_url('stokin/edit') ?>/" + $id,
                type: "get",
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.id_stok !== '') {
                        $('#inputId').val(obj.id_stok);
                        $('#inputItem').val(obj.id_item);
                        $('#inputPemasok').val(obj.id_pemasok);
                        $('#inputJumlah').val(obj.jumlah);
                        $('#inputKeterangan').val(obj.keterangan);
                    }
                }
            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputItem').val('');
            $('#inputPemasok').val('');
            $('#inputJumlah').val('');
            $('#inputKeterangan').val('');
        }

        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?= current_url() . '?' . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function () {
            var id_stok = $('#inputId').val();
            var id_item = $('#inputItem').val();
            var id_pemasok = $('#inputPemasok').val();
            var jumlah = $('#inputJumlah').val();
            var keterangan = $('#inputKeterangan').val();


            if (jumlah.trim() === '') {
                $('.error').html('nama kategori harus diisi.');
                $('.error').show();
                return; // Berhenti eksekusi jika validasi gagal
            }

            $.ajax({
                url: "<?= site_url('stokin/simpan') ?>",
                type: "POST",
                data: {
                    id: id_stok,
                    id_item: id_item,
                    id_pemasok: id_pemasok,
                    jumlah: jumlah,
                    keterangan: keterangan,
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
                    }
                }
            });
            bersihkan();
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