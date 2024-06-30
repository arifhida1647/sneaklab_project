<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakslab | Data Users</title>
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
                                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <select id="role" class="form-select" name="role">
                                                <option value="Admin">Admin</option>
                                                <option value="Operator">Operator</option>
                                                <option value="Owner">Owner</option>
                                            </select>
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
                            <h3 class="card-title">Data Admin</h3>
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
                                        <th>Admin ID</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $nomor = 0;
                                    foreach ($dataAdmin as $k => $v) {
                                        $nomor = $nomor + 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor ?></td>
                                            <td><?php echo $v['admin_id'] ?></td>
                                            <td><?php echo $v['username'] ?></td>
                                            <td><?php echo $v['password'] ?></td>
                                            <td><?php echo $v['role'] ?></td>
                                            <td><?php echo $v['created_at'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="edit(<?php echo $v['admin_id'] ?>)">Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapus(<?php echo $v['admin_id'] ?>)">Delete</button>

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
        function hapus($admin_id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?php echo site_url("admin/hapus") ?>/" + $admin_id;
            }
        }

        function edit($admin_id) {
            $.ajax({
                url: "<?php echo site_url("admin/edit") ?>/" + $admin_id,
                type: "get",
                success: function (hasil) {
                    var $obj = $.parseJSON(hasil);
                    if ($obj.id != '') {
                        $('#inputId').val($obj.admin_id);
                        $('#inputUsername').val($obj.username);
                        $('#inputPassword').val($obj.password);
                        $('#role').val($obj.role);
                    }
                }

            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputUsername').val('');
            $('#inputPassword').val('');
            $('#role').val('');
        }
        $('.tombol-tutup').on('click', function () {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function () {
            var $admin_id = $('#inputId').val();
            var $username = $('#inputUsername').val();
            var $password = $('#inputPassword').val();
            var $role = $('#role').val();


            $.ajax({
                url: "<?php echo site_url("admin/simpan") ?>",
                type: "POST",
                data: {
                    admin_id: $admin_id,
                    username: $username,
                    password: $password,
                    role: $role
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