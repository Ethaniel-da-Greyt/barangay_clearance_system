<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/custom.css') ?>" rel="stylesheet">
    <link href="<?= base_url('sweetalert/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('icons/bootstrap-icons.css') ?>" rel="stylesheet">

    <title><?= $this->renderSection('title') ?></title>

    <style>
        .logout1 {
            transition: padding-right 0.3s ease-in, color 0.3s ease-in;
            color: white;
            text-decoration: none;
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
            <a class="navbar-brand text-white fw-bold me-5" href="/resident">Barangay Dicayas Clearance Issuance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav gap-3 ms-5">
                    <div class="">
                        <a href="/resident" class="nav-link text-white <?= $this->renderSection('home') ?>">Home</a>
                    </div>
                    <div class="">
                        <a href="/resident/profile"
                            class="nav-link text-white <?= $this->renderSection('profile') ?>">Profile</a>
                    </div>
                </ul>
            </div>
        </div>
        <div class="">
            <a href="/logout" class="me-3 fw-bold text-white logout1">Logout</a>
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
    <script>
        function checkNotifications() {
            fetch('/resident/check-notifications')
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(req => {
                            let message = '';
                            let rejectmsg = req.rejection_remarks;

                            if (req.status === 'approved') {
                                message = `Your request ${req.request_type} has been approved. You can now claim your request at the Barangay Dicayas Office.`;
                            } else if (req.status === 'rejected') {
                                message = `Your request ${req.request_type} has been rejected. ${rejectmsg}`;
                            } else {
                                message = `Your request ${req.request_type} has been ${req.status}.`;
                            }

                            Swal.fire({
                                icon: req.status === 'approved' ? 'success' : 'error',
                                title: req.status === 'approved' ? 'Request Approved!' : 'Request Rejected!',
                                text: message,
                                showConfirmButton: true
                                // timer: 4000 // optional auto-close
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        });
                    }
                })
                .catch(err => console.error(err));
        }

        // Poll every 5 seconds
        setInterval(checkNotifications, 5000);
    </script>

    <script src="<?= base_url('sweetalert/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>