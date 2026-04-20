<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Hospitals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <script>
        window.BASE_URL = "<?= BASE_URL ?>";
    </script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>"><i class="fas fa-hospital"></i> ABC Hospitals</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>admin/dashboard">Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>patient/dashboard">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>patient/book">Book Appointment</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>auth/logout">Logout (<?= $_SESSION['name'] ?>)</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>auth/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>auth/signup">Signup</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <?php require_once 'app/Views/' . $view . '.php'; ?>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2026 ABC Hospitals. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>public/js/app.js"></script>
</body>

</html>