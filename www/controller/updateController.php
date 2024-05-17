<?php

require_once "../views/head.php";
require_once "../controller/userManager.php";
require_once "../models/userModel.php";
$userManager = new UserManager();
$user = $userManager->getSelfUser($_SESSION['id']);
var_dump($_POST);   

if ($_POST) {
    $updateProfile = [];
    /* if (isset($_POST['password'])) {
        if ($_POST['password'] == $_POST['passwordVerify']) {
            $updateProfile['password'] = $_POST['password'];
        } else {
            header('location:'.'../views/updateProfile.php');
        }
    } else {
        $updateProfile['password'] = $user->getPassword();
    } */

    if (empty($_POST['firstName'])) {
        $updateProfile['firstName'] = $user->getFirstName();
    } else {
        $updateProfile['firstName'] = $_POST['firstName'];
    } 
    
    if (empty($_POST['name'])) {
        $updateProfile['name'] = $user->getName();
    } else {
        $updateProfile['name'] = $_POST['name'];
    } 
    
    if (empty($_POST['mail'])) {
        $updateProfile['mail'] = $user->getMail();  
    } else {
        $updateProfile['mail'] = $_POST['mail'];
    } $userManager->updateUser($updateProfile);
    header('Location:'.'../views/profile.php');  
}