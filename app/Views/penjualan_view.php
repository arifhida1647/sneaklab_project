<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Toko sembako Leon | Data Penjualan</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php echo view('sidebar'); ?>

        <!-- CONTAINER -->
        <div class="content-wrapper">
            <!-- CARD -->
            <div class="card">
                <div class="card-body">

                    <!-- TABLE OF ITEMS -->
                    <div class="card">
                        <div class="card-header py-3 text-white" style="background-color: #FF8225">
                            <h3 class="card-title">Data Invoice</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Pelanggan</th>
                                        <th>Total Harga</th>
                                        <th>Tunai</th>
                                        <th>Kembalian</th>
                                        <th>Catatan</th>
                                        <th>Tanggal</th>
                                        <th>status</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 0;
                                    foreach ($dataInvoice as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?= ++$nomor ?></td>
                                            <td><?= $v['id'] ?></td>
                                            <td><?= $v['username'] ?></td>
                                            <td><?= $v['nama_pelanggan'] ?></td>
                                            <td><?= $v['total_harga'] ?></td>
                                            <td><?= $v['tunai'] ?></td>
                                            <td><?= $v['kembalian'] ?></td>
                                            <td><?= $v['catatan'] ?></td>
                                            <td><?= $v['tanggal'] ?></td>
                                            <td>
                                                <?php
                                                $statusClass = ($v['status'] === 'sukses') ? 'btn-success' : 'btn-danger';
                                                ?>
                                                <button type="button" class="btn <?= $statusClass ?> btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <?= $v['status'] ?>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('invoiceDetail/' . $v['id']); ?>"><button
                                                        type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">View</button>
                                                </a>
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