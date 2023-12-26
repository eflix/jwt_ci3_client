   <!-- Begin Page Content -->
   <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= 'Daftar User' ?></h1>

        <div class="row">

        <table class="table">
            <thead>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
            </thead>
            <tbody>
                <?php foreach ($user as $key => $value) { ?>
                    <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $value->username; ?></td>
                        <td><?= $value->email; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        </div>  

                   

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->