<?php
// End the current session and remove all session data
session_destroy();
// Redirect the user to the home page (index.php)
header("location: ../index.php");
?>