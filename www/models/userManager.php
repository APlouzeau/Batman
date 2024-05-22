<?php

require_once APP_PATH . "/models/userModel.php";

class userManager extends PDOServer
{
    public function connectUser(string $email, string $password)
    {
        $req = $this->db->query("SELECT * FROM users WHERE mail = '$email'");
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_ASSOC);
            #if ($password == $user["password"]) {
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
        $req = $this->db->query("SELECT id, name, firstName, mail, role FROM users WHERE id = $id");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $user = new Users($data);
        return $user;
    }

    public function updateUser(array $updateProfile)
    {
        $req = $this->db->prepare("UPDATE users SET name = :name, firstName = :firstName, mail = :mail");
        $req->bindValue(":name", $updateProfile['name']);
        $req->bindValue(':firstName', $updateProfile['firstName']);
        $req->bindValue(':mail', $updateProfile['mail']);
        $req->execute();
    }

    public function modifyPasswordUser($userId, $oldPassword, $newPassword)
    {
        $req = $this->db->query("SELECT password FROM users WHERE id = $userId");
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_ASSOC);
            #if ($oldPassword == $user["password"]) {
            if (password_verify($oldPassword, $user["password"])) {
                $req = $this->db->prepare("UPDATE users SET password = :password");
                $req->bindValue(':password', password_hash($newPassword, PASSWORD_BCRYPT));
                $req->execute();
            }
        }
    }

    public function addUser(string $name, string $firstName, string $mail, string $password, int $role)
    {
        $req = $this->db->prepare('INSERT INTO users (name, firstName, mail, password, role) VALUES (:name, :firstName, :mail, :password, :role)');
        $req->bindValue(':name', $name);
        $req->bindValue(':firstName', $firstName);
        $req->bindValue(':mail', $mail);
        $req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        $req->bindValue(':role', $role);
        $req->execute();
    }
}
