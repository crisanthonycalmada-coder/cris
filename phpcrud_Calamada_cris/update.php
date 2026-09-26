<?php

session_start();

if (!isset($_SESSION['doctorID'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';

$id        = $_POST['DoctorID'] ?? null;
$firstname = trim($_POST['FirstName'] ?? '');
$lastname  = trim($_POST['LastName'] ?? '');
$specialty = trim($_POST['Specialty'] ?? '');
$username  = trim($_POST['username'] ?? '');

if (!$id || $firstname === '' || $lastname === '' || $username === '') {
    header('Location: doctors.php');
    exit();
}

$query = "UPDATE doctor
          SET FirstName = ?, LastName = ?, Specialty = ?, username = ?
          WHERE DoctorID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ssssi", $firstname, $lastname, $specialty, $username, $id);
$stmt->execute();
$stmt->close();
$conn->close();

header('Location: doctors.php');
exit();

?>
