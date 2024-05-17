<?php

require_once "../views/head.php";
require_once "../controller/userManager.php";
require_once "../models/userModel.php";
$userManager = new UserManager();
$user = $userManager->getSelfUser($_SESSION['id']); 

if ($_POST) {
    $updateProfile = [];
    if (isset($_POST['password'])) {
        if ($_POST['password'] == $_POST['passwordVerify']) {
            $newPassword = $_POST['password'];
        } else {
            echo 'les mots de passes ne sont pas identiques';
            header('location:'.'../views/updateProfile.php');
        }
    }
    try {
        $userManager->modifyPasswordUser($_SESSION['id'], $_POST['oldPassword'], $newPassword);
        header('Location:'.'../views/profile.php');
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}