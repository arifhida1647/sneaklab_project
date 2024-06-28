<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakslab | Data Log</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <?php echo view('sidebar'); ?>>

        <div class="content-wrapper">
            <div class="card mx-3">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Data Log</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>Admin ID</th>
                                <th>action details</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dataLog as $k => $v) {
                                ?>
                                <tr>
                                    <td><?= $v['log_id'] ?></td>
                                    <td><?= $v['admin_id'] ?></td>
                                    <td><?= $v['action'] ?></td>
                                    <td><?= $v['created_at'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Main Sidebar Container -->
        <?php echo view('footer'); ?>>

    </div>
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