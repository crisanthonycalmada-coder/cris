<?php

session_start();

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$firstname = trim($_POST['FirstName'] ?? '');
$lastname  = trim($_POST['LastName'] ?? '');
$specialty = trim($_POST['Specialty'] ?? '');
$username  = trim($_POST['username'] ?? '');
$password  = $_POST['password'] ?? '';

if ($firstname === '' || $lastname === '' || $username === '' || $password === '') {
    header("Location: index.php?error=1");
    exit();
}

// Make sure the username isn't already taken
$check = $conn->prepare("SELECT DoctorID FROM doctor WHERE username = ? LIMIT 1");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->close();
    $conn->close();
    header("Location: index.php?error=taken");
    exit();
}

$check->close();

$query = "INSERT INTO doctor (FirstName, LastName, Specialty, username, password)
          VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Insert failed: " . $conn->error);
}

$stmt->bind_param(
    "sssss",
    $firstname,
    $lastname,
    $specialty,
    $username,
    $password
);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php?success=1");
exit();

?>
