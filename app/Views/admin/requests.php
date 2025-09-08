<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Requests<?php $this->endSection() ?>

<?php $this->section('requests') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="container mt-5">
    <div class="row align-items-center mt-4">
        <div class="col-12 col-md-4 mb-2 mb-md-0">
            <h4 class="text-warning">Active Requests</h4>
        </div>

        <div class="col-12 col-md-4 mb-2 mb-md-0">
            <form action="">
                <input type="text" name="search" placeholder="Search Residents Here.." class="form-control">
            </form>
        </div>

        <div class="col-12 col-md-4 text-md-end">
            <select name="filter" id="" onchange="this.form.submit()" class="form-select">

            </select>
        </div>
    </div>
    <div class="border-bottom border-2 border-orange mt-3 mb-2"></div>
</div>
<?php $this->endSection() ?>