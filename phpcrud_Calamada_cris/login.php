<?php
session_start();

if (isset($_SESSION['doctorID'])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Doctor Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-page">

<div class="auth-wrapper">

    <!-- LEFT BRAND PANEL -->
    <div class="auth-visual">
        <div class="auth-visual-content">
            <div class="auth-icon">🩺</div>
            <h3>Manage your practice from one dashboard</h3>
            <p>
                Sign in to review your doctor profile, keep patient and
                appointment records up to date, and coordinate with your
                department.
            </p>
        </div>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="auth-form-panel">

        <div class="auth-box">

            <span class="auth-eyebrow">DOCTOR PORTAL</span>
            <h2>Welcome back</h2>
            <p class="auth-subtitle">Sign in with your username and password to continue.</p>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    Invalid username or password.
                </div>
            <?php } ?>

            <form action="check.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Username</label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required>
                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                            <i class="bi bi-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary w-100">

                    Sign in

                </button>

            </form>

            <p class="auth-footer-link">
                Don't have an account?
                <a href="index.php">Add one here</a>
            </p>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.toggle-password').forEach(function (button) {
    button.addEventListener('click', function () {
        var input = document.getElementById(button.dataset.target);
        var icon = document.getElementById(button.dataset.target + '-icon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
});
</script>

</body>
</html>