<div class="container my-5">
    <h2 class="text-success mb-4">Patient Dashboard</h2>
    <a href="<?= BASE_URL ?>patient/book" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Book New Appointment</a>
    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Date & Time</th><th>Doctor</th><th>Health Issue</th><th>Room</th><th>Status</th><th>Prescription</th></tr></thead>
                <tbody>
                    <?php foreach($appointments as $app): ?>
                    <tr>
                        <td><?= $app['slot_date'] ?> <?= $app['start_time'] ?></td>
                        <td><?= $app['doctor_name'] ?></td>
                        <td><?= $app['health_issue'] ?></td>
                        <td><?= $app['room_number'] ?? 'N/A' ?></td>
                        <td>
                            <span class="badge bg-<?= $app['status'] == 'completed' ? 'success' : ($app['status'] == 'pending' ? 'warning' : 'danger') ?>">
                                <?= ucfirst($app['status']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if($app['status'] == 'completed' && $app['prescription_file']): ?>
                                <a href="<?= BASE_URL ?>patient/download/<?= $app['id'] ?>" class="btn btn-sm btn-outline-success"><i class="fas fa-download"></i> Download</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>