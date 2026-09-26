<?php

session_start();

include 'database.php';

$editMode = false;
$doctor   = null;

/* ==============================
   EDIT MODE (?id=... in the URL)
============================== */

if (isset($_GET['id']) && $_GET['id'] !== '') {

    $editMode = true;

    // Editing requires being logged in
    if (!isset($_SESSION['doctorID'])) {
        header("Location: login.php");
        exit();
    }

    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT DoctorID, FirstName, LastName, Specialty, username FROM doctor WHERE DoctorID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();
    $stmt->close();

    if (!$doctor) {
        header("Location: doctors.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editMode ? 'Edit Doctor' : 'Add Doctor'; ?></title>

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
            <?php if ($editMode) { ?>
                <h3>Keep doctor records accurate</h3>
                <p>
                    Update a doctor's name, specialty, or username here.
                    Changes take effect the next time they sign in.
                </p>
            <?php } else { ?>
                <h3>Bring a new doctor onto the team</h3>
                <p>
                    Create an account for a doctor to give them access to
                    the portal. They'll sign in with the username and
                    password you set here.
                </p>
            <?php } ?>
        </div>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="auth-form-panel">

        <div class="auth-box">

            <span class="auth-eyebrow">DOCTOR PORTAL</span>
            <h2><?php echo $editMode ? 'Edit doctor' : 'Add a doctor'; ?></h2>
            <p class="auth-subtitle">
                <?php echo $editMode
                    ? 'Update this doctor\'s details below.'
                    : 'Fill in the details below to create an account.'; ?>
            </p>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                Doctor added successfully! You can now
                <a href="login.php">log in</a>.
            </div>
        <?php } ?>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                <?php if ($_GET['error'] === 'taken') { ?>
                    That username is already taken. Please choose another.
                <?php } else { ?>
                    Please fill in all required fields.
                <?php } ?>
            </div>
        <?php } ?>

        <form action="<?php echo $editMode ? 'update.php' : 'insert.php'; ?>" method="POST">

            <?php if ($editMode) { ?>
                <input type="hidden" name="DoctorID" value="<?php echo htmlspecialchars($doctor['DoctorID']); ?>">
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input
                    type="text"
                    name="FirstName"
                    class="form-control"
                    value="<?php echo $editMode ? htmlspecialchars($doctor['FirstName']) : ''; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input
                    type="text"
                    name="LastName"
                    class="form-control"
                    value="<?php echo $editMode ? htmlspecialchars($doctor['LastName']) : ''; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Specialty</label>
                <input
                    type="text"
                    name="Specialty"
                    class="form-control"
                    value="<?php echo $editMode ? htmlspecialchars($doctor['Specialty'] ?? '') : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    value="<?php echo $editMode ? htmlspecialchars($doctor['username']) : ''; ?>"
                    required>
            </div>

            <?php if (!$editMode) { ?>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                            <i class="bi bi-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>
            <?php } ?>

            <button type="submit" class="btn btn-primary w-100">
                <?php echo $editMode ? 'SAVE CHANGES' : 'ADD DOCTOR'; ?>
            </button>

        </form>

        <?php if ($editMode) { ?>
            <p class="auth-footer-link">
                <a href="doctors.php">← Back to Doctor Management</a>
            </p>
        <?php } else { ?>
            <p class="auth-footer-link">
                Already registered?
                <a href="login.php">Log in here</a>
            </p>
        <?php } ?>

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