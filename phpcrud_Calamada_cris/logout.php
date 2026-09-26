<?php

session_start();

// Remove session variables
session_unset();

// Destroy session
session_destroy();

// Go back to login.php
header("Location: login.php");
exit();

?>
