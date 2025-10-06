<?php $this->extend('user/layout/layout'); ?>
<?php $this->section('title'); ?> Welcome nig <?php $this->endSection(); ?>
<?php $this->section('home') ?>fw-bold border-bottom border-orange border-2<?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="mx-5 mt-4">
    <div class="d-flex justify-content-between align-items-center mt-2">
        <div class="col-3 col-md-3">
            <h4 class="text-warning">Request History</h4>
        </div>

        <div class="d-flex align-items-center">
            <div class="me-2 w-50">
                <form action="">
                    <input type="text" name="search" placeholder="Search requests Here.." class="form-control">
                </form>
            </div>
            <div class="">
                <form action="" method="get">
                    <select name="document" id="" onchange="this.form.submit()" class="form-select">
                        <option value="">Choose Request Type</option>
                        <?php $docs = $document->where('is_deleted', 0)->findAll();
                        foreach ($docs as $d): ?>
                            <option value="<?= $d['document_name'] ?>"><?= $d['document_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </form>
            </div>
        </div>



        <div class="">
            <button class="btn btn-orange text-white" data-bs-target="#make_requests" data-bs-toggle="modal">
                <i class="bi bi-file-earmark-text"></i>
                Make Request
            </button>
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
                        <?php
                        $status = strtolower($request['status']);
                        $isCanceled = (int) $request['is_canceled'];

                        if ($isCanceled === 1) {
                            // Canceled requests
                            $badgeText = 'Canceled';
                            $badgeColor = 'dark';
                        } else {
                            // Normal statuses
                            $badgeColor = match ($status) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                                default => 'secondary'
                            };
                            $badgeText = ucfirst($status);
                        }
                        ?>
                        <tr>
                            <td><?= esc(date('F d, Y  h:i A', strtotime($request['created_at']))) ?></td>
                            <td><?= esc($request['request_id']) ?></td>
                            <td>
                                <?php
                                $doc = $document->where('document_name', $request['request_type'])->first();
                                echo $doc ? esc($doc['document_name']) : '-';
                                ?>
                            </td>
                            <td><?= esc(trim($request['firstname'] . ' ' . $request['middle_initial'] . ' ' . $request['lastname'] . ' ' . $request['suffix'])) ?>
                            </td>
                            <td><?= esc($request['sex']) ?></td>
                            <td><?= esc($request['purok']) ?></td>
                            <td><?= esc($request['contact_no']) ?></td>
                            <td>
                                <button class="btn btn-light btn-sm border border-1"
                                    data-bs-target="#img_<?= esc($request['request_id']) ?>"
                                    data-bs-toggle="modal">View</button>
                            </td>
                            <td>P<?= esc(number_format($doc['fee'] ?? 0, 2)) ?></td>
                            <td>
                                <span class="badge text-bg-<?= $badgeColor ?> text-white">
                                    <?= esc($badgeText) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($isCanceled === 1): ?>
                                    <!-- Only canceled requests can resubmit -->
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary btn-sm me-2"
                                            style="--bs-btn-padding-y:.25rem; --bs-btn-padding-x:.5rem; --bs-btn-font-size:.75rem;"
                                            data-bs-toggle="modal" data-bs-target="#update_<?= esc($request['request_id']) ?>">
                                            <i class="bi bi-pencil me-2"></i> Update
                                        </button>
                                        <button class="btn btn-warning text-white btn-sm"
                                            style="--bs-btn-padding-y:.25rem; --bs-btn-padding-x:.5rem; --bs-btn-font-size:.75rem;"
                                            data-bs-toggle="modal" data-bs-target="#resubmit_<?= esc($request['request_id']) ?>">
                                            <i class="bi bi-arrow-repeat me-2"></i> Resubmit
                                        </button>
                                    </div>
                                <?php elseif ($status === 'pending'): ?>
                                    <!-- Pending requests can be updated or canceled -->
                                    <div class="d-flex justify-content-center align-items-center">
                                        <!-- <button class="btn btn-primary btn-sm"
                                            style="--bs-btn-padding-y:.25rem; --bs-btn-padding-x:.5rem; --bs-btn-font-size:.75rem;"
                                            data-bs-toggle="modal" data-bs-target="#update_<?= esc($request['request_id']) ?>">
                                            <i class="bi bi-pencil me-2"></i> Update
                                        </button> -->
                                        <button class="ms-2 btn btn-danger btn-sm"
                                            style="--bs-btn-padding-y:.25rem; --bs-btn-padding-x:.5rem; --bs-btn-font-size:.75rem;"
                                            data-bs-toggle="modal" data-bs-target="#cancel_<?= esc($request['request_id']) ?>">
                                            <i class="bi bi-x-circle me-2"></i> Cancel
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <!-- Approved or Rejected requests show None -->
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
                                    <div class="modal-body text-center">
                                        <picture>
                                            <img src="<?= base_url($request['photo'] ?? '') ?>" alt="No Photo" width="450">
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Cancel Modal-->
                        <div class="modal fade" id="cancel_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h4 class="text-white">Cancel Confirmation</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-3 text-center text-danger">Are you sure you want to cancel this request?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/resident/request/cancel" method="POST">
                                            <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                            <button class="btn btn-danger">Proceed</button>
                                        </form>
                                        <div class="btn btn-secondary" data-bs-dismiss="modal">Cancel</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Resubmit Modal-->
                        <div class="modal fade" id="resubmit_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h4 class="text-white">Resubmit Request</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-3 text-center text-warning">Are you sure you want to Resubmit this request?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/resident/request/resubmit" method="POST">
                                            <input type="hidden" name="id" value="<?= esc($request['id']) ?>">
                                            <button class="btn btn-warning text-white">Submit</button>
                                        </form>
                                        <div class="btn btn-secondary" data-bs-dismiss="modal">Cancel</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Update Modal-->
                        <div class="modal fade" id="update_<?= esc($request['request_id']) ?>">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="text-white">Update Request</h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <form action="/resident/update" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Choose Document to Request</label>
                                                <select name="request_type" id="select_<?= $request['id'] ?>"
                                                    class="form-select">
                                                    <?php foreach ($docs as $d): ?>
                                                        <option value="<?= esc($d['document_name']) ?>"
                                                            <?= ($request['request_type'] == $d['document_name']) ? 'selected' : '' ?>>
                                                            <?= esc($d['document_name']) ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                            <div id="display_<?= $request['id'] ?>" class="mt-2 mb-2 fw-bold ms-3"></div>
                                            <script>
                                                (function () {
                                                    const requirements = {
                                                        "Barangay Certification (Old Resident)": [
                                                            "Valid ID",
                                                            "School ID",
                                                            "Company / Office ID",
                                                            "Voter's ID",
                                                            "Fee: P100.00"
                                                        ],
                                                        "Community Tax Certificate (CTC)": [
                                                            "Valid ID",
                                                            "Latest copy of CTC"
                                                        ],
                                                        "Barangay Clearance": [
                                                            "CTC",
                                                            "Valid ID",
                                                            "Fee: P100.00"
                                                        ],
                                                        "Barangay Certification (New Resident)": [
                                                            "CTC",
                                                            "Valid ID",
                                                            "Endorsement from Purok Barangay Officials",
                                                            "Fee: P100.00"
                                                        ]
                                                    };

                                                    const select = document.getElementById("select_<?= $request['id'] ?>");
                                                    const reqDiv = document.getElementById("display_<?= $request['id'] ?>");

                                                    function showRequirements() {
                                                        const selectedDoc = select.value;
                                                        if (requirements[selectedDoc]) {
                                                            const list = requirements[selectedDoc]
                                                                .map(req => `<li>${req}</li>`)
                                                                .join("");
                                                            reqDiv.innerHTML =
                                                                `<h5 class="text-danger">Must have one of these:</h5><ul>${list}</ul>`;
                                                        } else {
                                                            reqDiv.innerHTML = `<i>No requirements available for this document.</i>`;
                                                        }
                                                    }

                                                    select.addEventListener("change", showRequirements);
                                                    showRequirements();
                                                })();
                                            </script>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="" class="form-label">First Name</label>
                                                    <input type="text" name="firstname" placeholder="Requestor Firstname"
                                                        class="form-control" value="<?= esc($request['firstname']) ?>" required>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label">Last Name</label>
                                                    <input type="text" name="lastname" placeholder="Requestor LastName"
                                                        class="form-control" value="<?= esc($request['lastname']) ?>" required>
                                                </div>
                                                <div class="col-2">
                                                    <label for="" class="form-label">M.I.<span
                                                            class="text-secondary">(Optional)</span></label>
                                                    <input type="text" name="middle_initial" placeholder="Middle Initial"
                                                        value="<?= esc($request['middle_initial']) ?>" class="form-control">
                                                </div>
                                                <div class="col-2">
                                                    <label for="" class="form-label">Suffix<span
                                                            class="text-secondary">(Optional)</span></label>
                                                    <input type="text" name="suffix" placeholder="eg. (Jr., Sr., III)"
                                                        value="<?= esc($request['suffix']) ?>" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">Sex</label>
                                                    <select name="sex" id="" class="form-select" required>
                                                        <option value="M" <?= ($request['sex'] === 'M' ? 'selected' : '') ?>>Male
                                                        </option>
                                                        <option value="F" <?= ($request['sex'] === 'F' ? 'selected' : '') ?>>Female
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">Purok</label>
                                                    <input type="text" name="purok" placeholder="Requestor's Purok"
                                                        class="form-control" value="<?= esc($request['purok']) ?>" required>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <label for="" class="form-label">Contact No.:</label>
                                                    <input type="text" name="contact_no"
                                                        value="<?= esc($request['contact_no']) ?>" placeholder="Contact Number"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label for="" class="form-label">Upload Requirements</label>
                                                <input type="file" name="photo" value="<?= esc($request['photo']) ?>"
                                                    class="form-control">
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
                        <td colspan="11" class="text-center">No Request Found</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <!--Make Request Modal-->
    <div class="modal fade" id="make_requests">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h4 class="text-white">Make a Request</h4>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/resident/make-request/" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="">
                            <p> <strong class="text-warning">Note:</strong> You can make up to <strong>3 requests</strong> per day.</p>
                        </div>
                        <hr>
                        <div class="mb-2">
                            <label for="" class="form-label">Choose Document to Request</label>
                            <select name="request_type" id="request_type" class="form-select">
                                <?php foreach ($docs as $d): ?>
                                    <option value="<?= $d['document_name'] ?>"><?= $d['document_name'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div id="requirements" class="mt-2 mb-2 fw-bold ms-3"></div>
                        <script>
                            const requirementsMap = {
                                "Barangay Certification (Old Resident)": [
                                    "Valid ID",
                                    "School ID",
                                    "Company / Office ID",
                                    "Voter's ID",
                                    "Fee: P100.00"
                                ],
                                "Community Tax Certificate (CTC)": [
                                    "Valid ID",
                                    "Latest copy of CTC"
                                ],
                                "Barangay Clearance": [
                                    "CTC",
                                    "Valid ID",
                                    "Fee: P100.00"
                                ],
                                "Barangay Certification (New Resident)": [
                                    "CTC",
                                    "Valid ID",
                                    "Endorsement from Purok Barangay Officials",
                                    "Fee: P100.00"
                                ]
                            };

                            function showRequirements() {
                                const select = document.getElementById("request_type");
                                const selectedDoc = select.value;
                                const reqDiv = document.getElementById("requirements");

                                if (requirementsMap[selectedDoc]) {
                                    const list = requirementsMap[selectedDoc]
                                        .map(req => `<li> ${req}</li>`)
                                        .join("");
                                    reqDiv.innerHTML = `<h5 class="text-danger">Must have one of these:</h5><ul>${list}</ul>`;
                                } else {
                                    reqDiv.innerHTML = `<i>No requirements available for this document.</i>`;
                                }
                            }

                            document.getElementById("request_type").addEventListener("change", showRequirements);

                            showRequirements();
                        </script>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" name="firstname" placeholder="Requestor Firstname"
                                    class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" name="lastname" placeholder="Requestor LastName" class="form-control"
                                    required>
                            </div>
                            <div class="col-2">
                                <label for="" class="form-label">M.I.<span
                                        class="text-secondary">(Optional)</span></label>
                                <input type="text" name="middle_initial" placeholder="Middle Initial"
                                    class="form-control">
                            </div>
                            <div class="col-2">
                                <label for="" class="form-label">Suffix<span
                                        class="text-secondary">(Optional)</span></label>
                                <input type="text" name="suffix" placeholder="eg. (Jr., Sr., III)" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4 mb-2">
                                <label for="" class="form-label">Sex</label>
                                <select name="sex" id="" class="form-select" required>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="" class="form-label">Purok</label>
                                <input type="text" name="purok" placeholder="Requestor's Purok" class="form-control"
                                    required>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="" class="form-label">Contact No.:</label>
                                <input type="text" name="contact_no" placeholder="Contact Number" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Upload Requirements</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-orange text-white">Submit</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>