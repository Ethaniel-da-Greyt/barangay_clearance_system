<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Total Populations<?php $this->endSection() ?>

<?php $this->section('population') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="container">
    <div class="container">
        <div class="row align-items-center mt-4">

            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <h4 class="text-dark">Population Lists</h4>
            </div>

            <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex">
                <form action="">
                    <input type="text" name="search" placeholder="Search Residents Here.." class="form-control">
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
                    <i class="bi bi-folder-plus"></i> Add Record
                </button>
            </div>
        </div>
        <hr>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Resident ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Initial</th>
                    <th>Suffix</th>
                    <th>Sex</th>
                    <th>Purok</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($groupedResidents)): ?>
                    <?php foreach ($groupedResidents as $year => $residents): ?>

                        <?php foreach ($residents as $resident): ?>
                            <tr>
                                <td><?= esc($resident['resident_id']) ?></td>
                                <td><?= esc($resident['firstname']) ?></td>
                                <td><?= esc($resident['lastname']) ?></td>
                                <td><?= esc($resident['middle_initial']) ?></td>
                                <td><?= esc($resident['suffix']) ?></td>
                                <td><?= esc($resident['sex']) ?></td>
                                <td><?= esc($resident['purok']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-sm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#update_<?= esc($resident['resident_id']) ?>">
                                            <i class="bi bi-pencil me-2"></i>
                                            Update
                                        </button>

                                        <button class="ms-2 btn btn-danger btn-sm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#delete_<?= esc($resident['resident_id']) ?>">
                                            <i class="bi bi-trash me-2"></i>
                                            Remove
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            <!--Edit Modal-->
                            <div class="modal fade" id="update_<?= esc($resident['resident_id']) ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="text-white">Update User</h4>
                                            <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                        </div>

                                        <form action="/admin/population/update" method="POST" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= esc($resident['id']) ?>">
                                                <div class="row">
                                                    <div class="col-6 mb-2">
                                                        <label for="" class="form-label">Last Name</label>
                                                        <input type="text" name="lastname" value="<?= $resident['lastname'] ?>"
                                                            placeholder="Last Name" class="form-control" required>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <label for="" class="form-label">First Name</label>
                                                        <input type="text" name="firstname" value="<?= $resident['firstname'] ?>"
                                                            placeholder="First Name" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-2">
                                                        <label for="" class="form-label">M.I. <span
                                                                class="text-secondary">(Optional)</span></label>
                                                        <input type="text" name="middle_initial"
                                                            value="<?= $resident['middle_initial'] ?>" placeholder="Middle Initial"
                                                            class="form-control">
                                                    </div>

                                                    <div class="col-6 mb-2">
                                                        <label for="" class="form-label">Suffix<span
                                                                class="text-secondary">(Optional)</span></label>
                                                        <input type="text" name="suffix"
                                                            value="<?= $resident['suffix'] ?>" placeholder="Suffix"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-2 row">
                                                    <div class="col-4">
                                                        <label for="" class="form-label">Sex</label>
                                                        <select name="sex" id="" class="form-select">
                                                            <option value="M" <?= $resident['sex'] === 'M' ? 'selected' : '' ?>>Male</option>
                                                            <option value="F" <?= $resident['sex'] === 'F' ? 'selected' : '' ?>>Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <label for="" class="form-label">Purok</label>
                                                        <input type="text" name="purok" value="<?= $resident['purok'] ?>"
                                                            placeholder="Purok" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Update</button>
                                                <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--Deletion Confirmation Modal-->
                            <div class="modal fade" id="delete_<?= esc($resident['resident_id']) ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h4 class="text-white">Delete Confirmation</h4>
                                            <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                        </div>

                                        <div class="modal-body">
                                            <p class="text-danger text-center fs-3">Are you sure you want to remove <?= esc(ucfirst($resident['firstname']) . " " . ucfirst($resident['lastname'])) ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/admin/population/delete" method="post">
                                                <input type="hidden" name="id" value="<?= esc($resident['id']) ?>">
                                                <button class="btn btn-danger">Confirm</button>
                                            </form>
                                            <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="8">
                                <span class="text-primary fw-bold">Census in year <?= esc($year) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No Resident Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>

<!--ADD POPULATION USER MODAL-->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="text-white">Add Residents</h4>
                <span class="btn btn-close" data-bs-dismiss="modal"></span>
            </div>

            <form action="/admin/population" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" name="lastname" placeholder="Last Name" class="form-control" required>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" name="firstname" placeholder="First Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">M.I. <span class="text-secondary">(Optional)</span></label>
                            <input type="text" name="middle_initial" placeholder="Middle Initial" class="form-control">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Suffix <span class="text-secondary">(Optional)</span></label>
                            <input type="text" name="suffix" placeholder="Suffix" class="form-control">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Purok</label>
                        <input type="text" name="purok" placeholder="Purok" class="form-control">
                    </div>
                    <div class="mb-2 row">
                        <div class="col-6">
                            <label for="" class="form-label">Sex</label>
                            <select name="sex" id="" class="form-select">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Census Year</label>
                            <input type="number" class="form-control" name="census_year" placeholder="Census Year Conducted" value="<?= date('Y') ?>" max="<?= date('Y') ?>">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Proceed</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>