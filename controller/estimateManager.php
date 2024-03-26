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
        echo 'méthode createEstimate appelée.';
        $req = $this->db->prepare("INSERT INTO estimate (nameEstimate, customer) VALUE (:nameEstimate, :customer");
        $req->bindValue(":nameEstimate", $estimate->getNameEstimate(), PDO::PARAM_STR);
        $req->bindValue(":customer", $estimate->getCustomer(), PDO::PARAM_STR);
        $req->execute();
        echo 'Devis créé.';
    }
}
