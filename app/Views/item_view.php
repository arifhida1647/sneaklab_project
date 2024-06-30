<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sneakslab | Data Item</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php echo view('sidebar'); ?>>

        <!-- CONTAINER -->
        <div class="content-wrapper">
            <!-- CARD -->
            <div class="card">
                <div class="card-body">

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
                                    <input type="hidden" id="inputId" name="item_id">
                                    <div class="mb-3 row">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputNama" name="item_name">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputWaktu" class="col-sm-2 col-form-label">Waktu</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputWaktu" name="waktu">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <select id="inputCategory" class="form-select" name="category">
                                                <option value="Cleaning">Cleaning</option>
                                                <option value="Repair">Repair</option>
                                                <option value="Repaint">Repaint</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputDescription"
                                            class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputDescription"
                                                name="description">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputPrice" name="price">
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
                        <div class="card-header bg-primary py-3">
                            <h3 class="card-title">Data Item</h3>
                        </div>
                        <button type="button" class="btn btn-info btn-sm my-3 py-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            + Tambah Data Item
                        </button>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 0;
                                    foreach ($dataItem as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?= ++$nomor ?></td>
                                            <td><?= $v['item_name'] ?></td>
                                            <td><?= $v['waktu'] ?></td>
                                            <td><?= $v['category'] ?></td>
                                            <td><?= $v['description'] ?></td>
                                            <td><?= $v['price'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="edit(<?php echo $v['item_id'] ?>)">Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapus(<?php echo $v['item_id'] ?>)">Delete</button>

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

        <?php echo view('footer'); ?>>
    </div>

    <script>
        function hapus(item_id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?= site_url('item/hapus') ?>/" + item_id;
            }
        }

        function edit($item_id) {
            $.ajax({
                url: "<?= site_url('item/edit') ?>/" + $item_id,
                type: "get",
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.item_id !== '') {
                        $('#inputId').val(obj.item_id);
                        $('#inputNama').val(obj.item_name);
                        $('#inputWaktu').val(obj.waktu);
                        $('#inputCategory').val(obj.category);
                        $('#inputDescription').val(obj.description);
                        $('#inputPrice').val(obj.price);
                    }
                }
            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputNama').val('');
            $('#inputWaktu').val('');
            $('#inputCategory').val('');
            $('#inputDescription').val('');
            $('#inputPrice').val('');
        }

        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?= current_url() . '?' . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function () {
            var item_id = $('#inputId').val();
            var item_name = $('#inputNama').val();
            var waktu = $('#inputWaktu').val();
            var category = $('#inputCategory').val();
            var description = $('#inputDescription').val();
            var price = $('#inputPrice').val();

            // Validasi input Item Name tidak boleh kosong
            if (item_name.trim() === '') {
                $('.error').html('Item Name harus diisi.');
                $('.error').show();
                return; // Berhenti eksekusi jika validasi gagal
            }

            $.ajax({
                url: "<?= site_url('item/simpan') ?>",
                type: "POST",
                data: {
                    item_id: item_id,
                    item_name: item_name,
                    waktu: waktu,
                    category: category,
                    description: description,
                    price: price,
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