<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <ul class="nav nav-tabs mb-3" id="loginTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#patient">Patient</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#admin">Staff</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="patient">
                            <form action="<?= BASE_URL ?>auth/login" method="POST">
                                <input type="hidden" name="role" value="patient">
                                <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                                <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                                <button type="submit" class="btn btn-primary w-100">Patient Login</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="admin">
                            <form action="<?= BASE_URL ?>auth/login" method="POST">
                                <input type="hidden" name="role" value="admin">
                                <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                                <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                                <button type="submit" class="btn btn-dark w-100">Admin Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>