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
                <input type="text" name="search" placeholder="Search requests Here.." class="form-control">
            </form>
        </div>

        <div class="col-12 col-md-4 text-md-end">
            <select name="filter" id="" onchange="this.form.submit()" class="form-select">

            </select>
        </div>
    </div>
    <div class="border-bottom border-2 border-orange mt-3 mb-2"></div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Initial</th>
                    <th>Suffix</th>
                    <th>Sex</th>
                    <th>Purok</th> 
                    <th>Contact No.</th>
                    <th>Photo of Requirments</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($requests): ?>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= esc($request['request_id']) ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a data-bs-toggle="modal" data-bs-target="#photo_<?= esc($request['request_id']) ?>">
                                    <img class="rounded-circle"
                                        src="<?= base_url('uploads/avatar/' . esc($request['request_id']) . '/' . esc($request['photo'])) ?>"
                                        width="50" alt="avatar">
                                </a>
                            </td>
                            <td><?= esc($request['request_id']) ?></td>
                            <td><?= esc($request['firstname']) ?></td>
                            <td><?= esc($request['lastname']) ?></td>
                            <td><?= esc($request['middle_initial']) ?></td>
                            <td><?= esc($request['suffix']) ?></td>
                            <td><?= esc($request['sex']) ?></td>
                            <td><?= esc($request['purok']) ?></td>
                            <td><?= esc($request['contact_no']) ?></td>
                            <td><?= esc($request['status']) ?></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#update_<?= esc($request['request_id']) ?>">
                                        <i class="bi bi-pencil me-2"></i>
                                        Update
                                    </button>

                                    <button class="ms-2 btn btn-danger btn-sm"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#delete_<?= esc($request['request_id']) ?>">
                                        <i class="bi bi-trash me-2"></i>
                                        Remove
                                    </button>

                                    <button class="ms-2 btn btn-warning btn-sm text-white"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#defaultPassword_<?= esc($request['request_id']) ?>">
                                        <i class="bi bi-unlock2 me-2"></i>
                                        Default Password
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="defaultPassword_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h4 class="text-white">Default Password</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-3 text-center text-warning">Are you sure you want to Default the Password of <?= esc($request['firstname']) ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/requests/default" method="post">
                                            <input type="hidden" name="id" value="id">
                                            <button class="btn btn-warning text-white">Default Password</button>
                                        </form>
                                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--View Avatar Modal-->
                        <div class="modal fade" id="photo_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-orange">
                                        <h4 class="text-white"><?= esc($request['firstname']) ?>'s Avatar</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>

                                    <div class="modal-body d-flex justify-content-center">
                                        <img class="rounded"
                                            src="<?= base_url('uploads/avatar/' . esc($request['request_id']) . '/' . $request['photo']) ?>"
                                            width="400" alt="No Photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Modal-->
                        <div class="modal fade" id="update_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="text-white">Update User</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>

                                    <form action="/admin/requests/update" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= esc($request['id']) ?>">
                                            <div class="row">
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">Last Name</label>
                                                    <input type="text" name="lastname" value="<?= $request['lastname'] ?>"
                                                        placeholder="Last Name" class="form-control" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">First Name</label>
                                                    <input type="text" name="firstname" value="<?= $request['firstname'] ?>"
                                                        placeholder="First Name" class="form-control" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">M.I. <span
                                                            class="text-secondary">(Optional)</span></label>
                                                    <input type="text" name="middle_initial"
                                                        value="<?= $request['middle_initial'] ?>" placeholder="Middle Initial"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col-4">
                                                    <label for="" class="form-label">Sex</label>
                                                    <select name="sex" id="" class="form-select">
                                                        <option value="M" <?= $request['sex'] === 'M' ? 'selected' : '' ?>>Male</option>
                                                        <option value="F" <?= $request['sex'] === 'F' ? 'selected' : '' ?>>Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-8 mb-2">
                                                    <label for="" class="form-label">Purok</label>
                                                    <input type="text" name="purok" value="<?= $request['purok'] ?>"
                                                        placeholder="Purok" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label for="" class="form-label">Username</label>
                                                    <input type="text" name="username" value="<?= $request['username'] ?>"
                                                        placeholder="Username" class="form-control" required>
                                                </div>

                                                <div class="col-6">
                                                    <label for="" class="form-label">User Role</label>
                                                    <select name="role" id="" class="form-select">
                                                        <option value="request" <?= $request['role'] === 'request' ? 'selected' : '' ?>>
                                                            request
                                                        </option>
                                                        <option value="admin" <?= $request['role'] === 'admin' ? 'selected' : '' ?>>
                                                            Admin
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label for="" class="form-label">Upload Photo <span
                                                        class="text-secondary">(Optional)</span></label>
                                                <input type="file" name="photo" id="" class="form-control">
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
                        <div class="modal fade" id="delete_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h4 class="text-white">Delete Confirmation</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>

                                    <div class="modal-body">
                                        <p class="text-danger text-center fs-3">Are you sure you want to remove <?= esc(ucfirst($request['firstname']) . " " . ucfirst($request['lastname'])) ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/requests/delete" method="post">
                                            <input type="hidden" name="id" value="<?= esc($request['id']) ?>">
                                            <button class="btn btn-danger">Confirm</button>
                                        </form>
                                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No User Found</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>