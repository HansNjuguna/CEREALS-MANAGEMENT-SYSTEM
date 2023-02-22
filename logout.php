<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}

// logout if session is set
if (isset($_SESSION['username'])) {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    header("Location: login.php");
    exit;
}
