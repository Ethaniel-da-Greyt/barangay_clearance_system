<?php $this->extend('layout/layout') ?>
<?php $this->section('title') ?>Requests<?php $this->endSection() ?>

<?php $this->section('requests') ?>fw-bold active border-bottom border-orange border-2 <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="m-5 mt-3">
    <div class="row align-items-center mt-4">
        <div class="col-3 col-md-3">
            <h4 class="text-warning">Requests Lists</h4>
        </div>

        <div class="col-3 col-md-3">
            <form action="">
                <input type="text" name="search" placeholder="Search requests Here.." class="form-control">
            </form>
        </div>

        <div class="col-3 col-md-3">
            <form action="" method="get">
                <select name="document" id="" onchange="this.form.submit()" class="form-select">
                    <option value="">Choose Request Type</option>
                    <?php $docs = $document->findAll();
                    foreach ($docs as $d): ?>
                        <option value="<?= $d['document_id'] ?>"><?= $d['document_name'] ?></option>
                    <?php endforeach ?>
                </select>
            </form>
        </div>

        <div class="col-3 col-md-3">
            <form action="" method="get">
                <select name="filter" id="" onchange="this.form.submit()" class="form-select">
                    <option class="text-center" value="">Choose Status</option>
                    <option value="approved">Aprroved/Done</option>
                    <option value="rejected">Rejected</option>
                    <option value="pending">Pending</option>
                </select>
            </form>
        </div>
    </div>
    <div class="border-bottom border-2 border-orange mt-3 mb-2"></div>

    <div class="table-responsive" style="height: 65vh;">
        <table class="table table-striped">
            <thead class="sticky-top table-dark">
                <tr>
                    <th>Date Requested</th>
                    <th>Request ID</th>
                    <th>Document</th>
                    <th>Requestor</th>
                    <th>Sex</th>
                    <th>Purok</th>
                    <th>Contact</th>
                    <th>Photo</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($requests): ?>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= esc(date('F d, Y - h:i A', strtotime($request['created_at']))) ?></td>
                            <td><?= esc($request['request_id']) ?></td>
                            <td>
                                <?php
                                $doc = $document->where('document_name', $request['request_type'])->first();
                                if($doc){echo esc($doc['document_name']);}else{echo '-';};
                                ?>
                            </td>
                            <td><?= esc($request['firstname'] . " " . $request['middle_initial'] . " " . $request['lastname'] . " " . $request['suffix']) ?></td>
                            <td><?= esc($request['sex']) ?></td>
                            <td><?= esc($request['purok']) ?></td>
                            <td><?= esc($request['contact_no']) ?></td>
                            <td>
                                <button class="btn btn-light btn-sm border border-1" data-bs-target="#img_<?= $request['request_id'] ?>" data-bs-toggle="modal">View</button>
                            </td>
                            <td>P<?= esc(number_format($doc['fee'], 2)) ?></td>
                            <?php
                            $color = null;
                            $status = esc($request['status']);
                            switch ($status) {
                                case 'pending':
                                    $color = 'warning';
                                    break;
                                case 'approved':
                                    $color = 'success';
                                    break;
                                case 'rejected':
                                    $color = 'danger';
                                    break;
                            }
                            ?>
                            <td><span class="badge text-bg-<?= $color ?> text-white"><?= ucfirst($status) ?></span></td>
                            <td><?php
                                if ($status !== 'rejected' && $status !== 'approved'): ?>

                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#approve_<?= esc($request['request_id']) ?>">
                                            <i class="bi bi-check-circle me-2"></i>
                                            Approve
                                        </button>

                                        <button class="ms-2 btn btn-danger btn-sm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            data-bs-toggle="modal" data-bs-target="#reject_<?= esc($request['request_id']) ?>">
                                            <i class="bi bi-x-circle me-2"></i>
                                            Reject
                                        </button>
                                    </div>

                                <?php else: ?>
                                    <div class="text-center">
                                        <span class="badge text-bg-dark px-4">None</span>
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>

                        <!--View Requirement Modal-->
                        <div class="modal fade" id="img_<?= $request['request_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom border-orange border-2">
                                        <h4 class="modal-title text-dark">Photo of Requirement</h4>
                                        <span class="btn btn-close btn-light" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <picture>
                                            <img src="<?= $request['photo'] ?>" alt="No Photo">
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Approval Modal-->
                        <div class="modal fade" id="approve_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h4 class="text-white">Confirmation Approval</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-3 text-center text-success">Are you sure you want to approve this request?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/requests/approve" method="POST">
                                            <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                            <button class="btn btn-success">Approve</button>
                                        </form>
                                        <div class="btn btn-secondary" data-bs-dismiss="modal">Cancel</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Rejection Modal-->
                        <div class="modal fade" id="reject_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h4 class="text-white">Confirmation Rejection</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-3 text-center text-danger">Are you sure you want to reject this request?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/requests/reject" method="POST">
                                            <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                            <button class="btn btn-danger">Reject</button>
                                        </form>
                                        <div class="btn btn-secondary" data-bs-dismiss="modal">Cancel</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Edit Modal-->

                        <!--Deletion Confirmation Modal
                        <div class="modal fade" id="delete_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h4 class="text-white">Delete Confirmation</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>

                                    <div class="modal-body">
                                        <p class="text-danger text-center fs-3">Are you sure you want to remove
                                            <?= esc(ucfirst($request['firstname']) . " " . ucfirst($request['lastname'])) ?>
                                        </p>
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
                        </div>-->
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No Request Found</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>

<?php $this->endSection() ?>