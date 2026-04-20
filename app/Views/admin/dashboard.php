<div class="container-fluid my-4 px-4">
    <div class="d-flex justify-content-between mb-4 align-items-center">
        <h2 class="text-success"><i class="fas fa-user-shield"></i> Admin Portal</h2>
        <?php if ($slotsExistToday): ?>
            <button class="btn btn-secondary" disabled title="Roster already generated for today"><i class="fas fa-calendar-check"></i> 7-Day Roster Generated</button>
        <?php else: ?>
            <a href="<?= BASE_URL ?>admin/generate_roster" class="btn btn-warning" onclick="return confirm('Generate exactly 7 slots per department per day for the next 7 days?')"><i class="fas fa-calendar-alt"></i> Auto-Generate 7-Day Roster</a>
        <?php endif; ?>
    </div>

    <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#appointments">Live Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#doctors">Manage Doctors</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#roster">Slot Roster</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#patients">Registered Patients</button>
        </li>
    </ul>

    <div class="tab-content shadow bg-white p-3 rounded">

        <div class="tab-pane fade show active" id="appointments">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-success"><tr><th>ID</th><th>Patient</th><th>Doctor</th><th>Date & Time</th><th>Issue</th><th>Room</th><th>Status</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php foreach($appointments as $app): ?>
                        <tr>
                            <form action="<?= BASE_URL ?>admin/update_appointment" method="POST" enctype="multipart/form-data" onsubmit="return validateCompletion(this)">
                                <input type="hidden" name="appointment_id" value="<?= $app['id'] ?>">
                                <input type="hidden" class="has-file" value="<?= !empty($app['prescription_file']) ? '1' : '0' ?>">
                                
                                <td><?= $app['id'] ?></td>
                                <td><?= $app['patient_name'] ?></td>
                                <td><?= $app['doctor_name'] ?></td>
                                <td><span class="badge bg-dark"><?= $app['slot_date'] ?></span> <br> <?= $app['start_time'] ?></td>
                                <td><?= $app['health_issue'] ?></td>
                                <td><input type="text" name="room_number" class="form-control form-control-sm" value="<?= $app['room_number'] ?>" placeholder="Room #"></td>
                                <td>
                                    <!-- Added class 'status-select' for JS -->
                                    <select name="status" class="form-select form-select-sm status-select">
                                        <option value="pending" <?= $app['status']=='pending'?'selected':'' ?>>Pending</option>
                                        <option value="completed" <?= $app['status']=='completed'?'selected':'' ?>>Completed</option>
                                        <option value="cancelled" <?= $app['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                                        <option value="absent" <?= $app['status']=='absent'?'selected':'' ?>>Absent</option>
                                    </select>
                                </td>
                                <td>
                                    <?php if(!empty($app['prescription_file'])): ?>
                                        <a href="<?= BASE_URL ?>admin/download/<?= $app['id'] ?>" class="btn btn-sm btn-outline-success w-100 mb-1"><i class="fas fa-download"></i> Download</a>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Update File (Optional):</small>
                                    <?php endif; ?>
                                    <!-- Added class 'file-input' for JS -->
                                    <input type="file" name="prescription" class="form-control form-control-sm mb-1 file-input" accept=".pdf,.jpg,.png">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                </td>
                            </form>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="doctors">
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDoctorModal"><i class="fas fa-user-md"></i> Add New Doctor</button>
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctors as $doc): ?>
                        <tr>
                            <td><?= $doc['id'] ?></td>
                            <td><?= $doc['name'] ?></td>
                            <td><?= $doc['dept_name'] ?></td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="roster">
            <h5 class="text-success mb-3">7-Day Slot Roster</h5>

            <div class="row mb-3 bg-light p-3 rounded">
                <div class="col-md-4">
                    <label>Filter by Date</label>
                    <input type="date" id="filterDate" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Filter by Department</label>
                    <select id="filterDept" class="form-control">
                        <option value="">All Departments</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['name'] ?>"><?= $dept['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Search Doctor</label>
                    <input type="text" id="filterDoc" class="form-control" placeholder="Type doctor name...">
                </div>
            </div>

            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-sm table-striped text-center" id="rosterTable">
                    <thead class="table-dark" style="position: sticky; top: 0;">
                        <tr>
                            <th>Doctor Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($slots)): ?>
                            <tr>
                                <td colspan="5">No slots generated yet. Click "Auto-Generate 7-Day Roster" above.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($slots as $slot): ?>
                                <tr class="roster-row">
                                    <td class="doc-name"><?= $slot['doctor_name'] ?></td>
                                    <td class="dept-name"><?= $slot['dept_name'] ?></td>
                                    <td class="slot-date"><?= $slot['slot_date'] ?></td>
                                    <td><?= $slot['start_time'] ?></td>
                                    <td>
                                        <?php if ($slot['is_booked']): ?>
                                            <span class="badge bg-danger">Booked</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Available</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="patients">
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $pat): ?>
                        <tr>
                            <td><?= $pat['id'] ?></td>
                            <td><?= $pat['name'] ?></td>
                            <td><?= $pat['email'] ?></td>
                            <td><?= $pat['phone'] ?></td>
                            <td><?= $pat['dob'] ?></td>
                            <td><?= $pat['gender'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="modal fade" id="addDoctorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add New Doctor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>admin/add_doctor" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Doctor Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Dr. John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label>Department</label>
                        <select name="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Doctor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterDate = document.getElementById('filterDate');
        const filterDept = document.getElementById('filterDept');
        const filterDoc = document.getElementById('filterDoc');
        const rows = document.querySelectorAll('.roster-row');

        function filterTable() {
            const dateVal = filterDate.value;
            const deptVal = filterDept.value.toLowerCase();
            const docVal = filterDoc.value.toLowerCase();

            rows.forEach(row => {
                const rowDate = row.querySelector('.slot-date').innerText;
                const rowDept = row.querySelector('.dept-name').innerText.toLowerCase();
                const rowDoc = row.querySelector('.doc-name').innerText.toLowerCase();

                let show = true;

                if (dateVal && rowDate !== dateVal) show = false;
                if (deptVal && rowDept !== deptVal) show = false;
                if (docVal && !rowDoc.includes(docVal)) show = false;

                row.style.display = show ? '' : 'none';
            });
        }

        if (filterDate) filterDate.addEventListener('change', filterTable);
        if (filterDept) filterDept.addEventListener('change', filterTable);
        if (filterDoc) filterDoc.addEventListener('keyup', filterTable);
    });

    window.validateCompletion = function(form) {
        const status = form.querySelector('.status-select').value;
        const fileInput = form.querySelector('.file-input');
        const hasFile = form.querySelector('.has-file').value === '1';

        if (status === 'completed' && !hasFile && fileInput.files.length === 0) {
            alert('Sorry!! Action Denied: You must upload a prescription file before marking this appointment as Completed.');
            fileInput.classList.add('border-danger');
            return false;
        }
        
        fileInput.classList.remove('border-danger');
        return true;
    };
</script>