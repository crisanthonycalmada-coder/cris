```php
<?php

session_start();

if (!isset($_SESSION['doctorID'])) {
    header("Location: login.php");
    exit();
}

$doctorName = $_SESSION['doctorName'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Doctor Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>

<body class="dashboard-page">

<!-- =========================
     SIDEBAR
========================= -->

<div class="sidebar">

    <div class="logo">
        <div class="doctor-logo">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>

        <div>
            <h3>Doctor Portal</h3>
            <small>Medical Management</small>
        </div>
    </div>


    <div class="doctor-info">

        <div class="profile-icon">
            <i class="bi bi-person-fill"></i>
        </div>

        <h5>
            <?php echo htmlspecialchars($doctorName); ?>
        </h5>

        <p>
            <i class="bi bi-circle-fill"></i>
            Online
        </p>

    </div>


    <!-- NAVIGATION -->

    <div class="navigation-title">
        MAIN MENU
    </div>

    <a href="home.php" class="menu active">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
    </a>

    <a href="doctors.php" class="menu">
        <i class="bi bi-person-badge-fill"></i>
        <span>Manage Doctors</span>
    </a>

    <a href="#" class="menu">
        <i class="bi bi-people-fill"></i>
        <span>Patients</span>
    </a>

    <a href="#" class="menu">
        <i class="bi bi-calendar-check-fill"></i>
        <span>Appointments</span>
    </a>

    <a href="#" class="menu">
        <i class="bi bi-hospital-fill"></i>
        <span>Departments</span>
    </a>


    <div class="logout-area">

        <a
            href="logout.php"
            class="logout"
            onclick="return confirm('Are you sure you want to logout?');">

            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>

        </a>

    </div>

</div>


<!-- =========================
     MAIN CONTENT
========================= -->

<div class="main-content">


    <!-- TOP BAR -->

    <div class="topbar">

        <div>

            <span class="dashboard-label">
                MEDICAL DASHBOARD
            </span>

            <h2>
                Welcome back, Doctor!
            </h2>

            <p>
                Here's what's happening in your medical portal today.
            </p>

        </div>


        <div class="topbar-profile">

            <div class="topbar-icon">
                <i class="bi bi-person-badge-fill"></i>
            </div>

            <div>
                <strong>
                    <?php echo htmlspecialchars($doctorName); ?>
                </strong>

                <small>
                    Doctor
                </small>
            </div>

        </div>

    </div>


    <!-- =========================
         STAT CARDS
    ========================= -->

    <div class="dashboard-cards">


        <!-- DOCTORS -->

        <div class="dashboard-card doctor-card">

            <div class="card-top">

                <div class="card-icon blue">
                    <i class="bi bi-person-badge-fill"></i>
                </div>

                <span class="card-number">
                    <i class="bi bi-arrow-up"></i>
                    Active
                </span>

            </div>

            <h4>Doctors</h4>

            <p>
                Manage doctor profiles and accounts.
            </p>

            <a href="doctors.php" class="card-button">
                Manage Doctors
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        <!-- PATIENTS -->

        <div class="dashboard-card patient-card">

            <div class="card-top">

                <div class="card-icon green">
                    <i class="bi bi-people-fill"></i>
                </div>

                <span class="card-number">
                    Records
                </span>

            </div>

            <h4>Patients</h4>

            <p>
                View and manage patient records.
            </p>

            <a href="#" class="card-button">
                View Patients
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        <!-- APPOINTMENTS -->

        <div class="dashboard-card appointment-card">

            <div class="card-top">

                <div class="card-icon orange">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>

                <span class="card-number">
                    Schedule
                </span>

            </div>

            <h4>Appointments</h4>

            <p>
                Check upcoming patient appointments.
            </p>

            <a href="#" class="card-button">
                View Appointments
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        <!-- DEPARTMENTS -->

        <div class="dashboard-card department-card">

            <div class="card-top">

                <div class="card-icon purple">
                    <i class="bi bi-hospital-fill"></i>
                </div>

                <span class="card-number">
                    Hospital
                </span>

            </div>

            <h4>Departments</h4>

            <p>
                View hospital departments and services.
            </p>

            <a href="#" class="card-button">
                View Departments
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    </div>


    <!-- =========================
         WELCOME PANEL
    ========================= -->

    <div class="welcome-card">

        <div class="welcome-content">

            <div class="welcome-badge">
                <i class="bi bi-heart-pulse-fill"></i>
                DOCTOR PORTAL
            </div>

            <h2>
                Your medical workspace
            </h2>

            <p>
                Manage doctors, patients, appointments, and hospital
                departments from one convenient dashboard.
            </p>

            <a href="doctors.php" class="welcome-button">
                Manage Doctors
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        <div class="welcome-illustration">

            <div class="medical-circle circle-one"></div>
            <div class="medical-circle circle-two"></div>

            <i class="bi bi-heart-pulse-fill"></i>

        </div>

    </div>


    <!-- =========================
         QUICK ACTIONS
    ========================= -->

    <div class="quick-section">

        <div class="section-heading">

            <div>
                <span>QUICK ACCESS</span>
                <h3>Common actions</h3>
            </div>

        </div>


        <div class="quick-grid">

            <a href="doctors.php" class="quick-card">
                <div class="quick-icon blue">
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <div>
                    <strong>Add / Manage Doctor</strong>
                    <small>Manage doctor accounts</small>
                </div>

                <i class="bi bi-chevron-right"></i>
            </a>


            <a href="#" class="quick-card">
                <div class="quick-icon green">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>

                <div>
                    <strong>Patient Records</strong>
                    <small>Open patient information</small>
                </div>

                <i class="bi bi-chevron-right"></i>
            </a>


            <a href="#" class="quick-card">
                <div class="quick-icon orange">
                    <i class="bi bi-calendar-plus-fill"></i>
                </div>

                <div>
                    <strong>Appointments</strong>
                    <small>View appointment schedule</small>
                </div>

                <i class="bi bi-chevron-right"></i>
            </a>

        </div>

    </div>


</div>

</body>
</html>
```
