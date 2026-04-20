<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Patient Registration</h4>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL ?>auth/signup" method="POST">
                        <div class="row mb-3">
                            <div class="col"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                            <div class="col"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                            <div class="col"><label>Phone</label><input type="text" name="phone" class="form-control" required></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col"><label>DOB</label><input type="date" name="dob" class="form-control" required></div>
                            <div class="col"><label>Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="Male">Male</option><option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>