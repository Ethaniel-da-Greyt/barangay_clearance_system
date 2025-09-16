<?php $this->extend('user/layout/layout'); ?>
<?php $this->section('title'); ?> Welcome nig <?php $this->endSection(); ?>
<?php $this->section('profile') ?>fw-bold border-bottom border-orange border-2<?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="container">
    <style>
        .profile-container {
            max-width: 600px;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .img-preview-container {
            text-align: center;
            margin-bottom: 1rem;
        }

        @media (max-width: 576px) {
            .profile-container {
                padding: 1.5rem 1rem;
            }
        }
    </style>
    <main class="mt-3 mb-3 container profile-container" role="main" aria-label="Profile Settings">
        <h1 class="mb-4 text-center text-orange">Profile Settings</h1>

        <!-- Tabs nav -->
        <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-orange" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                    type="button" role="tab" aria-controls="info" aria-selected="true">
                    User Info
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-orange" id="update-tab" data-bs-toggle="tab" data-bs-target="#update"
                    type="button" role="tab" aria-controls="update" aria-selected="false">
                    Update Profile
                </button>
            </li>
        </ul>

        <!-- Tabs content -->
        <div class="tab-content" id="profileTabsContent">
            <!-- User Info Tab -->
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                <div class="img-preview-container">
                    <img src="<?= base_url(esc($user['photo'])) ?>" alt="Profile Picture"
                        class="rounded-circle border border-orange border-4" width="150" />
                </div>

                <dl class="row">
                    <dt class="col-sm-4">Full Name</dt>
                    <dd class="col-sm-8">
                        <?= esc($user['firstname'] . " " . $user['middle_initial'] . " " . $user['lastname']) ?>
                    </dd>

                    <dt class="col-sm-4">Sex</dt>
                    <dd class="col-sm-8"><?= esc($user['sex']) ?></dd>
                    <dt class="col-sm-4">Purok</dt>
                    <dd class="col-sm-8"><?= esc($user['purok']) ?></dd>
                    <dt class="col-sm-4">Username</dt>
                    <dd class="col-sm-8" id="displayEmail"><?= esc($user['username']) ?></dd>
                </dl>
            </div>

            <!-- Update Profile Tab -->
            <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab" tabindex="0">
                <form action="/resident/profile/update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <div class="img-preview-container">
                        <img src="<?= base_url(esc($user['photo'])) ?>" alt="Profile Picture"
                            class="rounded-circle border border-orange border-4" width="200" style="" />
                    </div>

                    <div class="mb-3">
                        <label for="profile_pic" class="form-label">Profile Picture</label>
                        <input class="form-control" type="file" name="photo" accept="image/*" />
                    </div>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="name" name="firstname"
                            value="<?= esc($user['firstname']) ?>" placeholder="<?= esc($user['firstname']) ?>"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="name" name="lastname"
                            value="<?= esc($user['lastname']) ?>" placeholder="<?= esc($user['lastname']) ?>"
                            required />
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="name" name="middle_initial"
                                value="<?= esc($user['middle_initial']) ?>"
                                placeholder="<?= esc($user['middle_initial']) ?>" />
                        </div>

                        <div class="col-6">
                            <label for="sex" class="form-label">Sex</label>
                            <select name="sex" id="" class="form-select">
                                <option value="M" <?= $user['sex'] == 'M' ? 'selected' : '' ?>>Male</option>
                                <option value="F" <?= $user['sex'] == 'F' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="purok" class="form-label">Purok</label>
                        <input type="text" class="form-control" name="purok" value="<?= esc($user['purok']) ?>"
                            placeholder="<?= esc($user['purok']) ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= esc($user['username']) ?>" placeholder="<?= esc($user['username']) ?>"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Old Password <small class="text-muted">(leave blank to
                                keep current)</small></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="••••••••" />
                    </div>

                    <div class="mb-4">
                        <label for="password_confirm" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password_confirm" name="new_password"
                            placeholder="••••••••" />
                    </div>

                    <button type="submit" class="btn btn-orange text-white w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </main>
</div>
<?php $this->endSection() ?>