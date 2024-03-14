<?php

require_once "../models/rollsModel.php";

class RollsManager
{
    private $db;

    public function __construct()
    {
        $dbName = "sopeyo";
        $port = "3306";
        $userName = "root";
        try {
            $this->db = new PDO("mysql:host=localhost; dbname=$dbName; port=$port", $userName, "");
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "La connexion à la base de donnée a échouée.";
        }
    }

    public function addRolls(Rolls $rolls)
    {
        $req = $this->db->prepare("INSERT INTO rolls (name, length, recovery, description, price) VALUE (:name, :length, :recovery, :description, :price)");
        $req->bindValue(":name", $rolls->getName(), PDO::PARAM_STR);
        $req->bindValue(":length", $rolls->getLength(), PDO::PARAM_STR);
        $req->bindValue(":recovery", $rolls->getRecovery(), PDO::PARAM_STR);
        $req->bindValue(":description", $rolls->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":price", $rolls->getPrice(), PDO::PARAM_STR);
        $req->execute();
    }

    public function showRolls()
    {
        $rolls = [];
        $req = $this->db->query("SELECT * FROM rolls ORDER BY name");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $roll = new Rolls($data);
            $rolls[] = $roll;
        }
        return $rolls;
    }
}
