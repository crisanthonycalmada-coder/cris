<?php

session_start();

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header("Location: login.php?error=1");
    exit();
}

$query = "SELECT DoctorID, FirstName, LastName, username, password
          FROM doctor
          WHERE username = ?
          LIMIT 1";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Query failed: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $doctor = $result->fetch_assoc();

    if ($password === $doctor['password']) {

        $_SESSION['doctorID']   = $doctor['DoctorID'];
        $_SESSION['doctorName'] = $doctor['FirstName'] . ' ' . $doctor['LastName'];
        $_SESSION['username']   = $doctor['username'];

        header("Location: home.php");
        exit();

    } else {

        header("Location: login.php?error=1");
        exit();
    }

} else {

    header("Location: login.php?error=1");
    exit();
}

$stmt->close();
$conn->close();

?>
