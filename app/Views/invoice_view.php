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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice p-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-shop"></i> Toko Sembako Leon
                                            <small class="float-right"><?= $data[0]['tanggal'] ?></small>
                                        </h4>
                                    </div>

                                </div>

                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        From
                                        <address>
                                            <strong>Toko Sembako Leon</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            Phone: (804) 123-5432<br>
                                            Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="ee87808881ae8f82838f9d8f8b8b8a9d9a9b8a8781c08d8183">[email&#160;protected]</a>
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        To
                                        <address>
                                            <strong>John Doe</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            Phone: (555) 539-1037<br>
                                            Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="b4dedbdcda9ad0dbd1f4d1ccd5d9c4d8d19ad7dbd9">[email&#160;protected]</a>
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice #<?= $data[0]['id'] ?></b><br>
                                        <br>
                                        <b>Order ID:</b> 4F3S8J<br>
                                        <b>Payment Due:</b> <?= $data[0]['tanggal'] ?><br>
                                        <b>Account:</b> 968-34567
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Jumlah</th>
                                                    <th>Product</th>
                                                    <th>Diskon</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $nomor = 0;
                                                foreach ($transaksi as $k => $v) {
                                                    ?>
                                                    <tr>
                                                        <th><?= $v['jumlah_item'] ?></th>
                                                        <th><?= $v['nama_item'] ?></th>
                                                        <th><?= $v['diskon_item'] ?></th>
                                                        <th>Rp <?= $v['subtotal'] ?></th>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Total:</th>
                                                    <td>Rp <?= $data[0]['total_harga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tunai:</th>
                                                    <td>Rp <?= $data[0]['tunai'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kembalian:</th>
                                                    <td>Rp <?= $data[0]['kembalian'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

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