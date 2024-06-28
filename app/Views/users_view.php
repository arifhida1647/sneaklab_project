<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakslab | Data Users</title>
       <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
       <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/Adminlte.min.css'); ?>">
</head>

<body class="hold-transition sidebar-mini">

    <?php echo view('sidebar'); ?>>
    <div class="'wrapper">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Form Pegawai</h5>
                                    <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- KALAU ERROR -->
                                    <div class="alert alert-danger error" role="alert" style="display: none;">
                                    </div>
                                    <!-- KALAU SUKSES -->
                                    <div class="alert alert-primary sukses" role="alert" style="display: none;">
                                    </div>
                                    <!-- FORM INPUT DATA -->
                                    <input type="hidden" id="inputId">
                                    <div class="mb-3 row">
                                        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputUsername"
                                                name="inputUsername">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword"
                                                name="inputPassword">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputFullName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputFullName"
                                                name="inputFullName">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPhoneNumber" class="col-sm-2 col-form-label">Nomor
                                            Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPhoneNumber"
                                                name="inputPhoneNumber">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputAddress" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAddress"
                                                name="inputAddress">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary py-3">
                            <h3 class="card-title">Data Orders</h3>
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info btn-sm my-3 py-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            + Tambah Data Pegawai
                        </button>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Nama</th>
                                        <th>email</th>
                                        <th>phone number</th>
                                        <th>address</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataUsers as $k => $v) {
                                        $nomor = $nomor + 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor ?></td>
                                            <td><?php echo $v['username'] ?></td>
                                            <td><?php echo $v['password'] ?></td>
                                            <td><?php echo $v['full_name'] ?></td>
                                            <td><?php echo $v['email'] ?></td>
                                            <td><?php echo $v['phone_number'] ?></td>
                                            <td><?php echo $v['address'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="edit(<?php echo $v['user_id'] ?>)">Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapus(<?php echo $v['user_id'] ?>)">Delete</button>

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
    </div>
    <?php echo view('footer'); ?>>
    <script>
        function hapus($user_id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?php echo site_url("users/hapus") ?>/" + $user_id;
            }
        }

        function edit($user_id) {
            $.ajax({
                url: "<?php echo site_url("users/edit") ?>/" + $user_id,
                type: "get",
                success: function (hasil) {
                    var $obj = $.parseJSON(hasil);
                    if ($obj.id != '') {
                        $('#inputId').val($obj.user_id);
                        $('#inputUsername').val($obj.username);
                        $('#inputPassword').val($obj.password);
                        $('#inputFullName').val($obj.full_name);
                        $('#inputEmail').val($obj.email);
                        $('#inputPhoneNumber').val($obj.phone_number);
                        $('#inputAddress').val($obj.address);
                    }
                }

            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputUsername').val('');
            $('#inputPassword').val('');
            $('#inputFullName').val('');
            $('#inputEmail').val('');
            $('#inputPhoneNumber').val('');
            $('#inputAddress').val('');
        }
        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function () {
            var $user_id = $('#inputId').val();
            var $username = $('#inputUsername').val();
            var $password = $('#inputPassword').val();
            var $full_name = $('#inputFullName').val();
            var $email = $('#inputEmail').val();
            var $phone_number = $('#inputPhoneNumber').val();
            var $address = $('#inputAddress').val();


            $.ajax({
                url: "<?php echo site_url("users/simpan") ?>",
                type: "POST",
                data: {
                    user_id: $user_id,
                    username: $username,
                    password: $password,
                    full_name: $full_name,
                    email: $email,
                    phone_number: $phone_number,
                    address: $address
                },
                success: function (hasil) {
                    var $obj = $.parseJSON(hasil);
                    if ($obj.sukses == false) {
                        $('.sukses').hide();
                        $('.error').show();
                        $('.error').html($obj.error);
                    } else {
                        $('.error').hide();
                        $('.sukses').show();
                        $('.sukses').html($obj.sukses);
                    }
                }
            });
            bersihkan();

        });
    </script>
    <!-- Page specific script -->
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