<?php

class EstimateManager
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

    public function createEstimate(Estimate $estimate)
    {
        $req = $this->db->prepare("INSERT INTO estimate (ressources) VALUE (:ressources)");
        $req->bindValue(":ressources", $estimate->getRessources(), PDO::PARAM_STR);
        $req->execute();
    }

    public function createLine(array $datas)
    {
        $req = $this->db->prepare("INSERT INTO estimate (ressources");
    }
}
