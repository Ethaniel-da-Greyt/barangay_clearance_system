<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/custom.css') ?>" rel="stylesheet">
    <link href="<?= base_url('sweetalert/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('icons/bootstrap-icons.css') ?>" rel="stylesheet">

    <title><?= $this->renderSection('title') ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="/">Barangay Dicayas Clearance Issuance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-bold active text-white" aria-current="page" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="/admin/residence">Registered Residents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="#">Population</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="/">List of Fire
                            Incidents</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="">
            <a href="" class="btn text-white">Logout</a>
        </div>
    </nav>


    <?= $this->renderSection('body') ?>

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