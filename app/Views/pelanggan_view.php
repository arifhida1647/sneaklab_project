<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Toko sembako Leon | Data Pelanggan</title>
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
                                    <input type="hidden" id="inputId" name="id">
                                    <div class="mb-3 row">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputNama"
                                                name="nama_pelanggan">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputTlp" class="col-sm-2 col-form-label">Nomor Pelanggan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputTlp" name="telp_pelanggan">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat
                                            Pelanggan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAlamat"
                                                name="alamat_pelanggan">
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
                            <h3 class="card-title">Data Pelanggan</h3>
                        </div>
                        <button type="button" class="btn btn-info btn-sm my-3 py-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            + Tambah Data Pelanggan
                        </button>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Nomor Pelanggan</th>
                                        <th>Alamat Pelanggan</th>
                                        <th>Tanggal Perubahan</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 0;
                                    foreach ($dataUsers as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?= ++$nomor ?></td>
                                            <td><?= $v['id'] ?></td>
                                            <td><?= $v['nama_pelanggan'] ?></td>
                                            <td><?= $v['telp_pelanggan'] ?></td>
                                            <td><?= $v['alamat_pelanggan'] ?></td>
                                            <td><?= $v['updated_at'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="edit(<?php echo $v['id'] ?>)">Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapus(<?php echo $v['id'] ?>)">Delete</button>

                                            </td>
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
                window.location = "<?= site_url('pelanggan/hapus') ?>/" + id;
            }
        }

        function edit($id) {
            $.ajax({
                url: "<?= site_url('pelanggan/edit') ?>/" + $id,
                type: "get",
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.id !== '') {
                        $('#inputId').val(obj.id);
                        $('#inputNama').val(obj.nama_pelanggan);
                        $('#inputTlp').val(obj.telp_pelanggan);
                        $('#inputAlamat').val(obj.alamat_pelanggan);

                    }
                }
            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputNama').val('');
            $('#inputTlp').val('');
            $('#inputAlamat').val('');
        }

        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?= current_url() . '?' . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function () {
            var id = $('#inputId').val();
            var nama_pelanggan = $('#inputNama').val();
            var telp_pelanggan = $('#inputTlp').val();
            var alamat_pelanggan = $('#inputAlamat').val();

            if (nama_pelanggan.trim() === '') {
                $('.error').html('nama pelanggan harus diisi.');
                $('.error').show();
                return; // Berhenti eksekusi jika validasi gagal
            }

            $.ajax({
                url: "<?= site_url('pelanggan/simpan') ?>",
                type: "POST",
                data: {
                    id: id,
                    nama_pelanggan: nama_pelanggan,
                    telp_pelanggan: telp_pelanggan,
                    alamat_pelanggan: alamat_pelanggan,
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