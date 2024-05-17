<?php

require_once "userManager.php";

if (isset($_GET['logout'])) {
    session_start();
    session_unset();
    header('location:'.'../views/index.php');
}