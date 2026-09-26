<?php

session_start();

if (!isset($_SESSION['doctorID'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $query = "DELETE FROM doctor WHERE DoctorID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header('Location: doctors.php');
exit();

?>
