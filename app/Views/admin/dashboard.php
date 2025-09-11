<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Admin<?php $this->endSection() ?>

<?php $this->section('dashboard') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 text-center">

        <div class="col">
            <div class="card h-100 border-3 border-primary rounded-4 shadow">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Residence</h5>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <i class="bi bi-person-vcard me-2 text-primary fs-2"></i>
                        <h3 class="text-primary mb-0"><?= esc($totalResidents) ?></h3>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card h-100 border-3 border-warning rounded-4 shadow">
                <div class="card-body">
                    <h5 class="card-title text-warning">Total Populations</h5>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <i class="bi bi-people me-2 text-warning fs-2"></i>
                        <h3 class="text-warning mb-0"><?= esc($totalPopulation) ?></h3>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card h-100 border-3 border-success rounded-4 shadow">
                <div class="card-body">
                    <h5 class="card-title text-success">Total Active Requests</h5>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <i class="bi bi-people me-2 text-success fs-2"></i>
                        <h3 class="text-success mb-0"><?= esc($totalActiveRequests) ?></h3>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card h-100 border-3 rounded-4 shadow" style="border-color: orange;">
                <div class="card-body">
                    <h5 class="card-title" style="color: orange;">Fire Incidence in 2025</h5>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <i class="bi bi-people me-2 fs-2" style="color: orange;"></i>
                        <h3 class="mb-0" style="color: orange;"><?= esc($firecase) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->endSection() ?>