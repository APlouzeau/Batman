<?php
require_once APP_PATH . "/models/PDOServer.php";
require_once APP_PATH . "/models/userManager.php";
require_once APP_PATH . "/models/roleManager.php";

class UserController
{

    public function formConnectUser()
    {
        if (!$_SESSION) {
            require_once APP_PATH . "/views/formConnectUser.php";
        } else {
        }
    }

    public function connectUserController()
    {
        $userManager = new userManager();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['mail']) && isset($_POST['password'])) {
                $email = $_POST['mail'];
                $password = $_POST['password'];
                try {
                    $userManager->connectUser($email, $password);
                    header('location: ' . BASE_URL);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

    public function disconnect()
    {
        session_unset();
        header('Location: ' . BASE_URL);
    }

    public function profile()
    {
        $userManager = new userManager();
        $user = $userManager->getSelfUser($_SESSION['id']);
        require_once APP_PATH . "/views/profile.php";
    }

    public function updateProfilePage()
    {
        require_once APP_PATH . "/views/updateProfile.php";
    }
    public function updateProfile()
    {
        $userManager = new userManager();
        $user = $userManager->getSelfUser($_SESSION['id']);

        if ($_POST) {
            $updateProfile = [];
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
            }
            $userManager->updateUser($updateProfile);
            $this->profile();
        }
    }

    public function updatePasswordPage()
    {
        require_once APP_PATH . "/views/updatePassword.php";
    }

    public function updatePassword()
    {
        $userManager = new userManager();
        $user = $userManager->getSelfUser($_SESSION['id']);
        if ($_POST) {
            if (isset($_POST['password'])) {
                if ($_POST['password'] == $_POST['passwordVerify']) {
                    $newPassword = $_POST['password'];
                } else {
                    echo 'les mots de passes ne sont pas identiques';
                }
            }
            try {
                $userManager->modifyPasswordUser($_SESSION['id'], $_POST['oldPassword'], $newPassword);
                $this->profile();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }

    public function usersAccountPage()
    {
        $userManager = new userManager();
        $users = $userManager->getAllUsers();
        $roleManager = new roleManager();
        $roleList = $roleManager->getAllRoles();
        require_once APP_PATH . '/views/usersAccount.php';
    }

    public function addUser()
    {
        if ($_POST) {
            $userManager = new userManager();
            $firstName = $_POST['firstName'];
            $name = $_POST['name'];
            $email = $_POST['mail'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            try {
                $userManager->addUser($firstName, $name, $email, $password, $role);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
}
