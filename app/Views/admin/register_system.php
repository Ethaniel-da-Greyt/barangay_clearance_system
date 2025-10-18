<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Total Populations<?php $this->endSection() ?>

<?php $this->section('register') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>

<div class="container-fluid">
    <div class="card border-0 shadow-sm p-2">
        <div class="card-header bg-light">
            <h4 class="m-0">ESP Systems</h4>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <?php foreach ($system as $d): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card text-center rounded shadow-sm border-0 h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="m-0"><?= esc($d['household'] ?: $d['esp_id']) ?></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text mb-1"><strong>Household:</strong> <?= esc($d['household'] ?: 'N/A') ?>
                                </p>
                                <p class="card-text mb-3"><strong>Location:</strong> <?= esc($d['address'] ?: 'N/A') ?></p>
                                <button class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#m<?= $d['esp_id'] ?>">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="m<?= $d['esp_id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Update System <?= esc($d['esp_id']) ?></h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Household</label>
                                            <input type="text" name="household" value="<?= esc($d['household']) ?>"
                                                class="form-control" placeholder="Enter Household Name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" value="<?= esc($d['address']) ?>"
                                                class="form-control" placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection() ?>