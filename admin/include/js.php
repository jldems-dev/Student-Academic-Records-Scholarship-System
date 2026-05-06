
			
            <script src="../js/jquery.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery.overlayScrollbars.min.js"></script>
            <script src="../js/adminlte.min.js"></script>
            <script src="../js/demo.js"></script>
            <script src="../js/jquery.dataTables.min.js"></script>
            <script src="../js/dataTables.bootstrap4.min.js"></script>
            <script src="../js/dataTables.responsive.min.js"></script>
            <script src="../js/responsive.bootstrap4.min.js"></script>
            <script src="../js/sweetalert2.min.js"></script>
            <script src="../js/toastr.min.js"></script>
            <script src="../js/bs-custom-file-input.min.js"></script>
            <script src="../js/croppie.js"></script>

        <script type="text/javascript">
            
        function myFunction() {
            var x = document.getElementById("currentPassword");
            var y = document.getElementById("newPassword");
            var z = document.getElementById("confirmPassword");

            if (x.type === "password" && y.type === "password" && z.type === "password") {
                x.type = "text";
                y.type= "text";
                z.type= "text";
            } else {
                x.type = "password";
                y.type= "password";
                z.type= "password";
            }
        }
        </script>

            <?php 
            if(isset($_SESSION['msg']) && $_SESSION['status']!=''){
                    ?>
                    <script>
                    Swal.fire({
                    position: 'top-center',
                    icon: '<?php echo $_SESSION['status']?>',
                    title: '<?php echo $_SESSION['msg']; ?>',
                    showConfirmButton: false,
                    timer: 2000
                    });
                    </script>
                <?php
                unset($_SESSION['msg']);
            }?>
</body>
</html>