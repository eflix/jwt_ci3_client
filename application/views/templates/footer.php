<!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Alda Media <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/select2.min.js"></script>

    <!-- rubah role -->
    <script>
        $('#locn').select2();
        $('#sLocn').select2();
        $('#laundry').select2();
        $('#laundry1').select2();
        $('#namaBrg').select2();

        $('#nama').select2({
            tags: true
        });

       $('.custom-file-input').on('change', function(){
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
       });


        $('.form-check-input').on('click', function(){

            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('admin/changeaccess'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function(){
                    document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }
            });
        });
    </script>

    <!-- Cetak Surat nik editing done -->
    <!-- <script type="text/javascript">
        document.getElementById('nik').addEventListener('change', function() {
          console.log('You selected: ', this.value);

          const nik = this.value;

          $.ajax({
                url: '<?= base_url('surat/getPendudukByNik/'); ?>' + nik,
                method : 'post',
                // dataType: 'json',
                data: {
                    nik : nik
                },
                success: function(data){
                    data=JSON.parse(data);
                    // console.log(data);
                    $('[name="nama"]').val(data.dp_nama);
                    $('[name="tmptLahir"]').val(data.dp_tempat_lahir);
                    $('[name="tglLahir"]').val(data.dp_tanggal_lahir);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="status"]').val(data.status_perkawinan);
                    $('[name="wargaNegara"]').val(data.dp_kewarganegaraan);
                    $('[name="agama"]').val(data.dp_agama);
                }
            });

        });
    </script> -->


    <script type="text/javascript">
        var list = ['angular','angularJS', 'Ionic', 'javascript', 'jquery', 'react', 'emberJs', 'ReactNative'];
            
        $('.inputPesan').keypress(function (e) {
          if (e.which == 13) {
            console.log('insert pesan');
            for (var i = 0; i < list.length; i++) {
                console.log(list[i]);
            }
            // location.reload();
          }
        });
    </script>

</body>

</html>