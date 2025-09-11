<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Fire List Incidents<?php $this->endSection() ?>

<?php $this->section('fire_list') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="mx-5 mt-1">
    <div class="">
        <div class="row align-items-center mt-3 border-bottom border-2 border-orange mb-2">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <h4 class="text-orange">Fire Case Incidence Lists</h4>
            </div>

            <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex">
                <form action="">
                    <input type="text" name="search" placeholder="Search cases Here.." class="form-control">
                </form>

                <form method="" class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="ms-3">
                        <select name="year" onchange="this.form.submit()" class="form-select">
                            <option value="">-- Filter by Year --</option>
                            <?php foreach ($years as $year): ?>
                                <option value="<?= esc($year) ?>" <?= $selectedYear == $year ? 'selected' : '' ?>>
                                    <?= esc($year) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="col-12 col-md-4 text-md-end">
                <button class="btn btn-primary text-white w-md-auto"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                    <i class="bi bi-folder-plus"></i> Add Report
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Case ID</th>
                    <th>Date Occurance</th>
                    <th>Date Reported</th>
                    <th>Exact Location</th>
                    <th>Cause of Fire</th>
                    <th>Affected Households</th>
                    <th>Type of Occurancy</th>
                    <th>Casualties</th>
                    <th>Affected Individuals</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($groupedResidents)): ?>
                    <?php foreach ($groupedResidents as $year => $cases): ?>

                        <?php $no = 1;
                        foreach ($cases as $case): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($case['case_id']) ?></td>
                                <td><?= esc(date("F, d, Y - h:i A", strtotime($case['date_occurrence']))) ?></td>
                                <td><?= esc(date("F, d, Y - h:i A", strtotime($case['date_report']))) ?></td>
                                <td><?= esc($case['exact_location']) ?></td>
                                <td><?= esc($case['cause_of_fire']) ?></td>
                                <td><?= esc($case['affected_households']) ?></td>
                                <td><?= esc($case['type_of_occupancy']) ?></td>
                                <td><?= esc($case['casualties']) ?></td>
                                <td><?= esc($case['affected_individuals']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-sm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#update_<?= esc($case['case_id']) ?>">
                                            <i class="bi bi-pencil me-2"></i>
                                            Update
                                        </button>

                                        <button class="ms-2 btn btn-danger btn-sm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#delete_<?= esc($case['case_id']) ?>">
                                            <i class="bi bi-trash me-2"></i>
                                            Remove
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            <!--Edit Modal-->
                            <div class="modal fade" id="update_<?= esc($case['case_id']) ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom border-3 border-dark py-2">
                                            <h4 class="text-dark">Update Report</h4>
                                            <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                        </div>
                                        <form action="/admin/fire-list/update" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $case['id'] ?>">
                                            <div class="modal-body">
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label for="" class="form-label">Date Occurance</label>
                                                        <input type="datetime-local" name="date_occurrence" value="<?= esc(date('Y-m-d\TH:i', strtotime($case['date_occurrence']))) ?>" class="form-control" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="" class="form-label">Date Reported</label>
                                                        <input type="datetime-local" name="date_report" value="<?= esc(date('Y-m-d\TH:i', strtotime($case['date_report']))) ?>" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="" class="form-label">Exact Location</label>
                                                    <textarea class="form-control" name="exact_location" value="" required><?= esc($case['exact_location']) ?></textarea>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="" class="form-label">Cause of Fire</label>
                                                    <input type="text" name="cause_of_fire" value="<?= esc($case['cause_of_fire']) ?>" placeholder="" class="form-control">
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label for="" class="form-label">Affected Households</label>
                                                        <input type="text" name="affected_households" value="<?= esc($case['affected_households']) ?>" placeholder="" class="form-control" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="" class="form-label">Type of Occurancy</label>
                                                        <input type="text" name="type_of_occupancy" value="<?= esc($case['type_of_occupancy']) ?>" placeholder="" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label for="" class="form-label">Casualties</label>
                                                        <input type="text" name="casualties" value="<?= esc($case['casualties']) ?>" placeholder="" class="form-control" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="" class="form-label">Affected Individuals</label>
                                                        <input type="text" name="affected_individuals" value="<?= esc($case['affected_individuals']) ?>" placeholder="" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-dark">Update</button>
                                                <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--Deletion Confirmation Modal-->
                            <div class="modal fade" id="delete_<?= esc($case['case_id']) ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title text-white">Confirm to Delete</h4>
                                            <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                        </div>
                                        <div class="modal-body">
                                            <p class="fs-3 text-danger text-center">Are you sure you want to delete this report?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/admin/fire-list/delete" method="post">
                                                <input type="hidden" name="id" value="<?= esc($case['id']) ?>">
                                                <button class="btn btn-danger">Confirm</button>
                                            </form>
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="11">
                                <span class="text-primary fw-bold">Fire Case Incidents (<?= esc($year) ?>)</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">No Record Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>

<!--ADD REPORT MODAL-->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom border-3 border-dark py-2">
                <h4 class="text-dark">Submit Report</h4>
                <span class="btn btn-close" data-bs-dismiss="modal"></span>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="" class="form-label">Date Occurance</label>
                            <input type="datetime-local" name="date_occurrence" id="" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Date Reported</label>
                            <input type="datetime-local" name="date_report" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Exact Location</label>
                        <textarea class="form-control" name="exact_location" id="" required></textarea>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Cause of Fire</label>
                        <input type="text" name="cause_of_fire" placeholder="" class="form-control">
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="" class="form-label">Affected Households</label>
                            <input type="text" name="affected_households" placeholder="" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Type of Occurancy</label>
                            <input type="text" name="type_of_occupancy" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="" class="form-label">Casualties</label>
                            <input type="text" name="casualties" placeholder="" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Affected Individuals</label>
                            <input type="text" name="affected_individuals" placeholder="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark">Submit</button>
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>