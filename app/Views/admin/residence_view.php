<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Total Registered Residence<?php $this->endSection() ?>

<?php $this->section('residents') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="container">
    <div class="container">
        <div class="row align-items-center mt-4">

            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <h4 class="text-dark">List of Residents Users</h4>
            </div>

            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <form action="">
                    <input type="text" name="search" placeholder="Search Residents Here.." class="form-control">
                </form>
            </div>

            <div class="col-12 col-md-4 text-md-end">
                <button class="btn btn-primary text-white w-md-auto"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                    <i class="bi bi-people"></i> Add Resident
                </button>
            </div>
        </div>
        <hr>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Initial</th>
                    <th>Sex</th>
                    <th>Purok</th>
                    <th>Username</th>
                    <th>User Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($residents): ?>
                    <?php foreach ($residents as $resident): ?>
                        <tr>
                            <td><?= esc($resident['user_id']) ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a data-bs-toggle="modal" data-bs-target="#photo_<?= esc($resident['user_id']) ?>">
                                    <img class="rounded-circle"
                                        src="<?= base_url('uploads/avatar/' . esc($resident['user_id']) . '/' . esc($resident['photo'])) ?>"
                                        width="50" alt="avatar">
                                </a>
                            </td>
                            <td><?= esc($resident['firstname']) ?></td>
                            <td><?= esc($resident['lastname']) ?></td>
                            <td><?= esc($resident['middle_initial']) ?></td>
                            <td><?= esc($resident['sex']) ?></td>
                            <td><?= esc($resident['purok']) ?></td>
                            <td><?= esc($resident['username']) ?></td>
                            <td><?= esc($resident['role']) ?></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#update_<?= esc($resident['user_id']) ?>">
                                        <i class="bi bi-pencil me-2"></i>
                                        Update
                                    </button>

                                    <button class="ms-2 btn btn-danger btn-sm"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#delete_<?= esc($resident['user_id']) ?>">
                                        <i class="bi bi-trash me-2"></i>
                                        Remove
                                    </button>

                                    <button class="ms-2 btn btn-warning btn-sm text-white"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#defaultPassword_<?= esc($resident['user_id']) ?>">
                                        <i class="bi bi-unlock2 me-2"></i>
                                        Default Password
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="defaultPassword_<?= esc($resident['user_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h4 class="text-white">Default Password</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-3 text-center text-warning">Are you sure you want to Default the Password of <?= esc($resident['firstname']) ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/residents/default" method="post">
                                            <input type="hidden" name="id" value="id">
                                            <button class="btn btn-warning text-white">Default Password</button>
                                        </form>
                                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--View Avatar Modal-->
                        <div class="modal fade" id="photo_<?= esc($resident['user_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-orange">
                                        <h4 class="text-white"><?= esc($resident['firstname']) ?>'s Avatar</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>

                                    <div class="modal-body d-flex justify-content-center">
                                        <img class="rounded"
                                            src="<?= base_url('uploads/avatar/' . esc($resident['user_id']) . '/' . $resident['photo']) ?>"
                                            width="400" alt="No Photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Modal-->
                        <div class="modal fade" id="update_<?= esc($resident['user_id']) ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="text-white">Update User</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>

                                    <form action="/admin/residents/update" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= esc($resident['id']) ?>">
                                            <div class="row">
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">Last Name</label>
                                                    <input type="text" name="lastname" value="<?= $resident['lastname'] ?>"
                                                        placeholder="Last Name" class="form-control" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">First Name</label>
                                                    <input type="text" name="firstname" value="<?= $resident['firstname'] ?>"
                                                        placeholder="First Name" class="form-control" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">M.I. <span
                                                            class="text-secondary">(Optional)</span></label>
                                                    <input type="text" name="middle_initial"
                                                        value="<?= $resident['middle_initial'] ?>" placeholder="Middle Initial"
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

                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label for="" class="form-label">Username</label>
                                                    <input type="text" name="username" value="<?= $resident['username'] ?>"
                                                        placeholder="Username" class="form-control" required>
                                                </div>

                                                <div class="col-6">
                                                    <label for="" class="form-label">User Role</label>
                                                    <select name="role" id="" class="form-select">
                                                        <option value="resident" <?= $resident['role'] === 'resident' ? 'selected' : '' ?>>
                                                            Resident
                                                        </option>
                                                        <option value="admin" <?= $resident['role'] === 'admin' ? 'selected' : '' ?>>
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
                        <div class="modal fade" id="delete_<?= esc($resident['user_id']) ?>">
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
                                        <form action="/admin/residents/delete" method="post">
                                            <input type="hidden" name="id" value="<?= esc($resident['id']) ?>">
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
    <div class="d-flex justify-content-center mt-3">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>

<!--ADD RESIDENT USER MODAL-->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="text-white">Add Residents</h4>
                <span class="btn btn-close" data-bs-dismiss="modal"></span>
            </div>

            <form action="/admin/residents" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" name="lastname" placeholder="Last Name" class="form-control" required>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" name="firstname" placeholder="First Name" class="form-control" required>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">M.I. <span class="text-secondary">(Optional)</span></label>
                            <input type="text" name="middle_initial" placeholder="Middle Initial" class="form-control">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-4">
                            <label for="" class="form-label">Sex</label>
                            <select name="sex" id="" class="form-select">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="col-8 mb-2">
                            <label for="" class="form-label">Purok</label>
                            <input type="text" name="purok" placeholder="Purok" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Password</label>
                            <input type="text" name="password" placeholder="Password" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <label for="" class="form-label">User Role</label>
                            <select name="role" id="" class="form-select">
                                <option value="resident">Resident</option>
                                <option value="admin">Admin</option>
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
                    <button class="btn btn-primary">Proceed</button>
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>