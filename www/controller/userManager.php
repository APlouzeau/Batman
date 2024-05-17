<?php
require_once "../models/PDOServer.php";
class UserManager extends PDOServer {

    public function connectUser(string $email, string $password)
    {
        echo "connectUser appelée";
        $req = $this->db->query("SELECT * FROM users WHERE mail = '$email'");
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user["password"])) {
                echo 'Bonjour' . ' ' . $user["firstName"] . ' ' . $user["name"];
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['id'] = $user['id'];
                if ($user['role'] == 1) {
                    $_SESSION['role'] = 'Assistant';
                } else if ($user['role'] == 2) {
                    $_SESSION['role'] = 'Conducteur de travaux';
                } else if ($user['role'] == 3) {
                    $_SESSION['role'] = 'Comptable';
                } else if ($user['role'] == 4) {
                    $_SESSION['role'] = 'Chef de secteur';
                } else if ($user['role'] == 5) {
                    $_SESSION['role'] = 'Chef d\'agence';
                } else if ($user['role'] == 6) {
                    $_SESSION['role'] = 'Administrateur';
                }
            } else {
                echo 'Identifiants invalides';
            }
        }
        return $req->execute();
    }

    public function getSelfUser($id) {
        $req = $this->db->query("SELECT id, name, firstName, mail, role FROM users WHERE id = $id");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $user = new Users($data);
        return $user;
    }

    public function updateUser(array $updateProfile) {
        $req = $this->db->prepare("UPDATE users SET name = :name, firstName = :firstName, mail = :mail, password = :password");
        $req->bindValue(":name", $updateProfile['name']);
        $req->bindValue(':firstName', $updateProfile['firstName']);
        $req->bindValue(':mail', $updateProfile['mail']);
        $req->bindValue(':password', $updateProfile['password']);
        $req->execute();
    }

    public function modifyPasswordUser ($userId, $oldPassword, $newPassword) {
        $req = $this->db->query("SELECT password FROM users WHERE id = $userId");
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_ASSOC);
            if (password_verify($oldPassword, $user["password"])) {
                $req = $this->db->prepare("UPDATE users SET password = :password");
                $req->bindValue(':password', password_hash($newPassword, PASSWORD_BCRYPT));
                $req->execute();
            }
        }
    }
}