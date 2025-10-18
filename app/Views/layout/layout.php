<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/custom.css') ?>" rel="stylesheet">
    <link href="<?= base_url('sweetalert/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('logo/logo.png') ?>" type="image/png">

    <title><?= $this->renderSection('title') ?></title>

    <style>
        .logout1 {
            transition: padding-right 0.3s ease-in, color 0.3s ease-in;
            color: white;
        }

        .logout1:hover {
            padding-right: 20px;
            color: orange !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="/">Barangay Dicayas Clearance Issuance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item me-2 ms-3">
                        <a class="nav-link <?= $this->renderSection('dashboard') ?> text-white" aria-current="page"
                            href="/admin">Dashboard</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link <?= $this->renderSection('requests') ?> text-white"
                            href="/admin/requests">Requests</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link <?= $this->renderSection('residents') ?> text-white"
                            href="/admin/residents">Registered Residents</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link <?= $this->renderSection('population') ?> text-white"
                            href="/admin/population">Population</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('fire_list') ?> text-white"
                            href="/admin/fire-list">List of Fire
                            Incidents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('reports') ?> text-white"
                            href="/admin/view-reports">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('register') ?> text-white"
                            href="/admin/register">Register ESP</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="">
            <a href="/logout" class="btn fw-bold text-white logout1">Logout</a>
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

    <script>
        function checkFireNotifications() {
            fetch('/admin/check-fire-notifications') // your route to the PHP method
                .then(res => res.json())
                .then(data => {
                    // Ensure data format is valid
                    if (data.status === 200 && data.notifications && data.notifications.length > 0) {
                        data.notifications.forEach(fire => {
                            let message =
                                `🔥 FIRE ALERT DETECTED!

                                📍 Location: ${fire.exact_location || 'Unknown'}
                                                        
                                🏠 Household: ${fire.household || 'N/A'}
                                                        
                                ⚠️ Alert Level: ${fire.status ? fire.status.toUpperCase() : 'N/A'}
                                `;
                                                        

                            Swal.fire({
                                icon: 'warning',
                                title: 'Fire Case Alert',
                                text: message,
                                confirmButtonText: 'Acknowledge',
                                confirmButtonColor: '#d33',
                            }).then(result => {
                                if (result.isConfirmed) {
                                    // Optional: refresh data or UI after acknowledgement
                                    location.reload();
                                }
                            });
                        });
                    }
                })
                .catch(err => console.error('Error checking fire notifications:', err));
        }

        // Poll every 5 seconds
        setInterval(checkFireNotifications, 5000);
    </script>

</body>

</html>