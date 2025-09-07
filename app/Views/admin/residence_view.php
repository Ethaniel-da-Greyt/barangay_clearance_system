<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Total Registered Residence<?php $this->endSection() ?>

<?php $this->section('body') ?>
<div class="container">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-dark mt-4">List of Residents Users</h4>
            <form action="">
                <input type="text" name="search" id="" placeholder="Search Residents Here.." class="form-control">
            </form>

            <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addModal">Add
                Resident</button>
        </div>
        <hr>
    </div>

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
                        <td><?= $resident['user_id'] ?></td>
                        <td class="d-flex justify-content-center align-items-center">
                            <a data-bs-toggle="modal" data-bs-target="#photo_<?= $resident['user_id'] ?>">
                                <img class="rounded-circle"
                                    src="<?= base_url('uploads/avatar/' . $resident['user_id'] . '/' . $resident['photo']) ?>"
                                    width="50" alt="avatar">
                            </a>
                        </td>
                        <td><?= $resident['firstname'] ?></td>
                        <td><?= $resident['lastname'] ?></td>
                        <td><?= $resident['middle_initial'] ?></td>
                        <td><?= $resident['sex'] ?></td>
                        <td><?= $resident['purok'] ?></td>
                        <td><?= $resident['username'] ?></td>
                        <td><?= $resident['role'] ?></td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                    data-bs-toggle="modal" data-bs-target="#update_<?= $resident['user_id'] ?>">
                                    <i class="bi bi-pencil me-2"></i>
                                    Update
                                </button>

                                <button class="ms-2 btn btn-danger btn-sm"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-trash me-2"></i>
                                    Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!--View Avatar Modal-->
                    <div class="modal fade" id="photo_<?= $resident['user_id'] ?>">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-orange">
                                    <h4 class="text-white"><?= $resident['firstname'] ?>'s Avatar</h4>
                                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                </div>

                                <div class="modal-body d-flex justify-content-center">
                                    <img class="rounded"
                                        src="<?= base_url('uploads/avatar/' . $resident['user_id'] . '/' . $resident['photo']) ?>"
                                        width="400" alt="No Photo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Edit Modal-->
                    <div class="modal fade" id="update_<?= $resident['user_id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="text-white">Update User</h4>
                                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                </div>

                                <form action="/admin/residence/update" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="modal-body">
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
                                            <div class="col-4">
                                                <label for="" class="form-label">Username</label>
                                                <input type="text" name="username" value="<?= $resident['username'] ?>"
                                                    placeholder="Username" class="form-control" required>
                                            </div>
                                            <div class="col-4">
                                                <label for="" class="form-label">Password</label>
                                                <input type="text" name="password" placeholder="Password" class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-4">
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
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center">No User Found</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
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

            <form action="/admin/residence" method="POST" enctype="multipart/form-data">
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