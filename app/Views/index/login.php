<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/custom.css') ?>" rel="stylesheet">
    <link href="<?= base_url('sweetalert/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('logo/logo.png') ?>" type="image/png">
    <title>Barangay Dicayas - Login</title>
</head>

<body>

<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
        <form class="p-4 rounded shadow" action="/login" method="post">
            <div class="">
                <h4 class="text-center text-orange">Login</h4>
                <div class="mb-2 mt-4">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>

                <div class="mb-2 mt-4">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>

                <button class="mb-2 btn btn-orange text-white form-control">Login</button>
                Don't have an Account?<a href="#"> Register here</a>
            </div>
        </form>
    </div>
</div>


    <?php if (session()->getFlashdata('success')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= session()->getFlashdata('success'); ?>',
                    showConfirmButton: true,
                });
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session()->getFlashdata('error'); ?>',
                    showConfirmButton: true,
                });
            });
        </script>
    <?php endif; ?>

    <script src="<?= base_url('sweetalert/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>