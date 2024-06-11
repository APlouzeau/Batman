<?php

require_once APP_PATH . "/models/entities/userModel.php";
require_once APP_PATH . "/models/entities/PDOServer.php";

class UserManager extends PDOServer
{
    public function connectUser(string $email, string $password)
    {
        if ($password == 1) {
            throw new Exception("Mon code est 1", 1);
        }
        $req = $this->db->query("SELECT * FROM users WHERE mail = '$email'");
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_ASSOC);
            #if ($user["password"] == $password) {
            if (password_verify($password, $user["password"])) {
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

    public function getAllUsers()
    {
        $req = $this->db->query('SELECT id, name, firstName, mail, role FROM users ORDER BY name');
        $datas = $req->fetchAll();
        $users = [];
        foreach ($datas as $data) {
            $user = new Users($data);
            $users[] = $user;
        }
        return $users;
    }

    public function getSelfUser($id)
    {
        $req = $this->db->prepare("SELECT id, name, firstName, mail, role FROM users WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $user = new Users($data);
        return $user;
    }

    public function updateUser(array $updateProfile)
    {
        $req = $this->db->prepare("UPDATE users SET name = :name, firstName = :firstName, mail = :mail WHERE id = :id");
        $req->bindValue(":name", $updateProfile['name']);
        $req->bindValue(':firstName', $updateProfile['firstName']);
        $req->bindValue(':mail', $updateProfile['mail']);
        $req->bindValue(':id', $updateProfile['id']);
        $req->execute();
    }

    public function modifyPasswordUser($userId, $oldPassword, $newPassword)
    {
        $req = $this->db->prepare("SELECT password FROM users WHERE id = :id");
        $req->bindValue(":id", $userId, PDO::PARAM_INT);
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_ASSOC);
            #if ($oldPassword == $user["password"]) {
            echo "mots de passes vérifié";
            if (password_verify($oldPassword, $user["password"])) {
                $req = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
                $req->bindValue(':password', password_hash($newPassword, PASSWORD_BCRYPT));
                $req->bindValue(':id', $userId, PDO::PARAM_INT);
                $req->execute();
            }
        }
    }

    public function addUser(string $name, string $firstName, string $mail, string $password, string $role)
    {
        $req = $this->db->prepare('INSERT INTO users (name, firstName, mail, password, role) VALUES (:name, :firstName, :mail, :password, :role)');
        $req->bindValue(':name', $name);
        $req->bindValue(':firstName', $firstName);
        $req->bindValue(':mail', $mail);
        $req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        $req->bindValue(':role', $role);
        $req->execute();
    }

    public function getDrivers()
    {
        $req = $this->db->query('SELECT * FROM users WHERE role = 2 OR role = 4 OR role = 5');
        $drivers = [];
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datas as $data) {
            $drivers[] = new Users($data);
        }
        return $drivers;
    }
}
