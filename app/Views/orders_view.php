<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakslab | Data Orders</title>
</head>

<body class="hold-transition sidebar-mini">

    <?php echo view('sidebar'); ?>>
    <div class="wrapper">

        <!-- CONTAINER -->
        <div class="content-wrapper">
            <!-- CARD -->
            <div class="card">
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
                                <input type="hidden" id="inputId" name="order_id">
                                <div class="mb-3 row">
                                    <label for="inputUserId" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUserId" name="user_id"
                                            disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select id="inputStatus" class="form-select" name="status">
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputTotalAmount" class="col-sm-2 col-form-label">Total
                                        Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputTotalAmount"
                                            name="total_amount" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPaymentProof" class="col-sm-2 col-form-label">path</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPaymentProof"
                                            name="payment_proof_path" disabled>
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
                <div class="card mx-3">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Data Orders</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User ID</th>
                                    <th>Item ID</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                    <th>Payment Proof Path</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataOrders as $k => $v) {
                                    ?>
                                    <tr>
                                        <td><?= ++$nomor ?></td>
                                        <td><?= $v['user_id'] ?></td>
                                        <td><?= $v['item_id'] ?></td>
                                        <td><?= $v['order_date'] ?></td>
                                        <td><?= $v['status'] ?></td>
                                        <td><?= $v['total_amount'] ?></td>
                                        <?php if (empty($v['payment_proof_path'])): ?>
                                            <td>Belum Upload</td>
                                        <?php else: ?>
                                            <td><a href="<?= $v['payment_proof_path'] ?>">Open Image</td>
                                        <?php endif; ?>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                onclick="edit(<?php echo $v['order_id'] ?>)">Edit</button>
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
    <script>
        function hapus(order_id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?= site_url('orders/hapus') ?>/" + order_id;
            }
        }

        function edit(order_id) {
            $.ajax({
                url: "<?= site_url('orders/edit') ?>/" + order_id,
                type: "get",
                success: function (hasil) {
                    var obj = $.parseJSON(hasil);
                    if (obj.order_id !== '') {
                        $('#inputId').val(obj.order_id);
                        $('#inputUserId').val(obj.user_id);
                        $('#inputStatus').val(obj.status);
                        $('#inputTotalAmount').val(obj.total_amount);
                        $('#inputPaymentProof').val(obj.payment_proof_path);
                    }
                }
            });
        }
        $(document).ready(function () {


            function bersihkan() {
                $('#inputId').val('');
                $('#inputUserId').val('');
                $('#inputStatus').val('');
                $('#inputTotalAmount').val('');
                $('#inputPaymentProof').val('');
            }


            $('.tombol-tutup').on('click', function () {
                if ($('.sukses').is(":visible")) {
                    window.location.href = "<?= current_url() . '?' . $_SERVER['QUERY_STRING'] ?>";
                }
                $('.alert').hide();
                bersihkan();
            });

            $('#tombolSimpan').on('click', function () {
                var order_id = $('#inputId').val();
                var user_id = $('#inputUserId').val();
                var status = $('#inputStatus').val();
                var total_amount = $('#inputTotalAmount').val();
                var payment_proof_path = $('#inputPaymentProof').val();

                var formData = new FormData();
                formData.append('order_id', order_id);
                formData.append('user_id', user_id);
                formData.append('status', status);
                formData.append('total_amount', total_amount);
                formData.append('payment_proof_path', payment_proof_path);

                $.ajax({
                    url: "<?= site_url('orders/simpan') ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
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