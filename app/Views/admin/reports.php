<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>View Reports<?php $this->endSection() ?>

<?php $this->section('reports') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="mx-5 mt-1">
    <div class="">
        <div class="row align-items-center mt-3 border-bottom border-2 border-orange mb-2">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <h4 class="text-orange">Reports</h4>
            </div>

            <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex">
                <form method="GET" class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="ms-3">
                        <input type="month" name="month" onchange="this.form.submit()" class="form-control">
                        <label for="" class="text-muted">Select Month to filter</label>
                    </div>
                </form>
            </div>

            <div class="col-12 col-md-4 text-md-end">
                <button class="btn btn-primary text-white w-md-auto" data-bs-toggle="modal" data-bs-target="#report">
                    <i class="bi bi-folder-plus"></i> Generate Report
                </button>
            </div>
        </div>
    </div>
    <?php if (!empty($lists)): ?>
        <?php foreach ($lists as $month => $list): ?>
            <div class="table-responsive mb-2">
                <h4><?= esc(date('F Y', strtotime($month))) ?></h4>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Date Requested</th>
                            <th>Request ID</th>
                            <th>Document</th>
                            <th>Requestor</th>
                            <th>Sex</th>
                            <th>Purok</th>
                            <th>Contact</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $l): ?>
                            <tr>
                                <td><?= esc(date('F d, Y', strtotime($l['created_at']))) ?></td>
                                <td><?= esc($l['request_id']) ?></td>
                                <td><?= esc($l['request_type']) ?></td>
                                <td><?= esc($l['firstname'] . " " . $l['middle_initial'] . " " . $l['lastname'] . " " . $l['suffix']) ?></td>
                                <td><?= esc($l['sex']) ?></td>
                                <td><?= esc($l['purok']) ?></td>
                                <td><?= esc($l['contact_no']) ?></td>
                                <td><?= esc($l['status']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <div class="">
            <h5 class="text-muted text-center mt-5">No record found.</h5>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="report">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Generate Reports</h4>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/admin/generate-reports" method="get">
                    <div class="modal-body">
                        <div class="">
                            <label for="" class="form-label">Select Month to Generate Reports</label>
                            <input type="month" name="month" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Generate</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>