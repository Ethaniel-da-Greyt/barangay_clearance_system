<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Admin<?php $this->endSection() ?>      

<?php $this->section('body') ?>
<div class="container mt-5">
    <div class="row gap-4 justify-content-center text-center">
        <div class="col-md-3 border border-primary border-3 rounded-4 p-4">
            <h4 class="text-primary">Total Residence</h4>
            <div class="d-flex justify-content-center align-items-center">
                <i class="bi bi-person-vcard me-3 text-primary fs-2"></i>
                <h3 class="text-center text-primary">200</h3>
            </div>
        </div>

        <div class="col-md-3 border border-warning border-3 rounded-4 p-4">
            <h4 class="text-warning ">Total Populations</h4>
            <div class="d-flex justify-content-center align-items-center"> 
                <i class="bi bi-people me-3 text-warning fs-2"></i><h3 class="text-warning">10</h3>
            </div>
        </div>

        <div class="col-md-3 border border-success border-3 rounded-4 p-4">
            <h4 class="text-success">Total Active Requests</h4>
            <div class="d-flex justify-content-center align-items-center"> 
                <i class="bi bi-people me-3 text-success fs-2"></i><h3 class="text-success">10</h3>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection() ?>