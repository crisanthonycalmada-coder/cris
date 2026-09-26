<?php

session_start();

if (!isset($_SESSION['doctorID'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';

$query = "SELECT DoctorID, FirstName, LastName, Specialty, username FROM doctor";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-5">

    <div class="mb-4">
        <h2>Doctor Management</h2>

        <p style="color: white;">
            Welcome,
            <strong><?php echo htmlspecialchars($_SESSION['doctorName']); ?></strong>
            !
        </p>
    </div>

    <div class="mb-3">

        <a href="index.php" class="btn btn-primary">
            Add Doctor
        </a>

        <a href="home.php" class="btn btn-secondary">
            Back to Dashboard
        </a>

        <a
            href="logout.php"
            class="btn btn-danger"
            onclick="return confirm('Are you sure you want to logout?');">

            Logout

        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Specialty</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php if ($result->num_rows > 0) { ?>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars($row['DoctorID']); ?></td>
                        <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                        <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Specialty'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td>

                            <a
                                href="index.php?id=<?php echo $row['DoctorID']; ?>"
                                class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a
                                href="delete.php?id=<?php echo $row['DoctorID']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this doctor?');">
                                Delete
                            </a>

                        </td>
                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="6" class="text-center">
                        No doctors found.
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
