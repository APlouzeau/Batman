<?php
require_once "../views/head.php";
require_once "../controller/userManager.php";

$userManager = new UserManager();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mail']) && isset($_POST['password'])) {
        $email = $_POST['mail'];
        $password = $_POST['password'];
        try {
            $userConnect = $userManager->connectUser($email, $password);
            echo'';
            header('location:'.'../views/index.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
