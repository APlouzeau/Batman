<?php
require_once APP_PATH . "/models/userManager.php";
require_once APP_PATH . "/models/roleManager.php";
require_once APP_PATH . "/controller/commonFunctions.php";

class UserController
{

    public function formConnectUser()
    {
        if (!isset($_SESSION['id'])) {
            $titlePage = 'Connexion';
            require_once APP_PATH . "/views/formConnectUser.php";
            require_once APP_PATH . "/views/footer.php";
        } else {
            require_once APP_PATH . "/views/home.php";
        }
    }

    public function connectUserController()
    {
        $userManager = new userManager();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['mail']) && isset($_POST['password'])) {
                $inputNames = [
                    'mail',
                    'password'
                ];
                $xss = xssConnect($inputNames);
                if (gettype($xss) == 'array') {
                    try {
                        $user = new Users($xss);
                        $connect = $userManager->connectUser($user);
                        if ($connect == true) {
                            header('location: ' . BASE_URL);
                        } else {
                            require_once APP_PATH . "/views/formConnectUser.php";
                            echo '<div class="error text-danger text-center mt-4" id="error">Identifiants invalides !</div>';
                            require_once APP_PATH . "/views/footer.php";
                        }
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                } else {
                    require_once APP_PATH . "/views/formConnectUser.php";
                    echo '<div class="error text-danger text-center mt-4" id="error">Identifiants invalides !</div>';
                    require_once APP_PATH . "/views/footer.php";
                }
            }
        }
    }

    public function disconnect()
    {
        session_unset();
        header('location: ' . BASE_URL);
    }

    public function profile()
    {
        $userManager = new userManager();
        $user = $userManager->getSelfUser($_SESSION['id']);
        $titlePage = 'Profil';
        require_once APP_PATH . "/views/profile.php";
    }

    public function updateProfilePage()
    {
        $titlePage = 'Mise à jour de profil';
        require_once APP_PATH . "/views/updateProfile.php";
    }
    public function updateProfile()
    {
        $userManager = new userManager();
        $user = $userManager->getSelfUser($_SESSION['id']);

        if ($_POST  && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            $updateProfile = [];
            $updateProfile['id'] = $user->getId();
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
            try {
                //code...
                $userManager->updateUser($updateProfile);
                $this->profile();
            } catch (\Throwable $e) {
                echo $e->getMessage();
            }
        }
    }

    public function updatePasswordPage()
    {
        $titlePage = 'Mot de passe';
        require_once APP_PATH . "/views/updatePassword.php";
    }

    public function updatePassword()
    {
        $userManager = new userManager();
        $user = $userManager->getSelfUser($_SESSION['id']);
        if ($_POST  && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            if (isset($_POST['password'])) {
                $regex = '/^(?=.*[\W])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,50}$/';
                if (preg_match($regex, $_POST['password'])) {
                    if ($_POST['password'] == $_POST['passwordVerify']) {
                        $newPassword = $_POST['password'];
                        try {
                            $userManager->modifyPasswordUser($_SESSION['id'], $_POST['oldPassword'], $newPassword);
                            $this->profile();
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                        }
                    } else {
                        echo '<div class="text-danger mb-5">Les mots de passe ne sont pas identique !</div>';
                    }
                } else {
                    $this->updatePasswordPage();
                    echo '<div class="text-danger mb-5">Le mot de passe ne respecte pas les exigences de sécurité !</div>';
                }
            } else {
                $this->updatePasswordPage();
                echo '<div class="text-danger mb-5">Le mot de passe n\'est pas renseigné !</div>';
            }
        }
    }

    public function usersAccountPage()
    {
        if ($_SESSION['role'] == 'Administrateur') {
            $userManager = new userManager();
            $users = $userManager->getAllUsers();
            $roleManager = new roleManager();
            $roleList = $roleManager->getAllRoles();
            $titlePage = 'Comptes d\'utilisateurs';
            require_once APP_PATH . '/views/usersAccount.php';
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function addUser()
    {
        if ($_SESSION['role'] == 'Administrateur' && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            if (!empty($_POST['mail']) && !empty($_POST['password'])) {
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    $userManager = new userManager();
                    $email = $_POST['mail'];
                    $firstName = $_POST['firstName'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];
                    $name = $_POST['name'];
                    try {
                        $userManager->addUser($firstName, $name, $email, $password, $role);
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                    }
                } else {
                    echo "L'adresse mail n'est pas valide";
                }
            } else {
                echo "Adresse mail et mot de passe obligatoire.";
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }
}
