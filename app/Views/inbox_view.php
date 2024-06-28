<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakslab | Data Inbox</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <?php echo view('sidebar'); ?>>

        <div class="content-wrapper">
            <div class="card mx-3">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Data Inbox</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>inbox_id</th>
                                <th>email</th>
                                <th>name</th>
                                <th>text</th>
                                <th>subject</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inboxData as $inbox): ?>
                                <tr>
                                    <td><?= esc($inbox['inbox_id']) ?></td>
                                    <td><?= esc($inbox['email']) ?></td>
                                    <td><?= esc($inbox['name']) ?></td>
                                    <td><?= esc($inbox['pesan']) ?></td>
                                    <td><?= esc($inbox['subject']) ?></td>
                                    <td><?= esc($inbox['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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