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

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4 col-sm-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h5 class="fw-bold text-orange">Barangay Dicayas Online</h5>
                        <small class="text-muted">Clearance Issuance</small>
                    </div>

                    <form action="/login" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter your username"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your password" required>
                        </div>

                        <button class="btn btn-orange text-white w-100 mb-3">Login</button>

                        <div class="text-center">
                            <small class="text-muted">Don't have an account?
                                <a href="#" class="text-orange text-decoration-none fw-semibold" data-bs-toggle="modal"
                                    data-bs-target="#signup">Register here</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h4 class="text-white">SignUp Here</h4>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/signup" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" name="firstname" placeholder="First Name*" class="form-control"
                                    required>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" name="lastname" placeholder="Last Name*" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="" class="form-label">Middle Initial <span
                                        class="text-muted">(Optional)</span> </label>
                                <input type="text" placeholder="Middle Initial (Optional)" name="middle_initial" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Sex</label>
                                <select name="sex" id="" class="form-select">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Purok</label>
                            <textarea name="purok" placeholder="Purok eg.(Purok Marupok)"
                                class="form-control"></textarea>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="" class="form-label">Username</label>
                                <input type="text" name="username" placeholder="Username*" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" placeholder="Minimum 5 characters"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"></label>
                            <input type="file" name="photo" id="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-orange text-white">SignUp</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
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