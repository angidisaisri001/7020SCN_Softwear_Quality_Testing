<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white"><h4>Book Appointment</h4></div>
        <div class="card-body">
            <form action="<?= BASE_URL ?>patient/confirm_booking" method="POST">
                <input type="hidden" name="slot_id" id="slot_id" required>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Department</label>
                        <select id="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <?php foreach($departments as $d): ?>
                                <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Doctor</label>
                        <select id="doctor" name="doctor_id" class="form-control" required><option value="">Select Doctor</option></select>
                    </div>
                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" id="date" class="form-control" min="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Available Slots (Live Updates)</label>
                    <div id="slots" class="p-3 border rounded bg-light min-vh-25">Select doctor and date to view slots.</div>
                </div>
                <div class="mb-3">
                    <label>Health Issue Details</label>
                    <textarea name="health_issue" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
            </form>
        </div>
    </div>
</div>