<?php

require_once "../models/typesModel.php";

class TypesManager
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

    public function addTypes(Types $type)
    {
        $req = $this->db->prepare("INSERT INTO type type VALUE :type");
        $req->bindValue(":name", $type->getName(), PDO::PARAM_STR);
        $req->execute();
    }

    public function showTypes()
    {
        $types = [];
        $req = $this->db->query("SELECT * FROM type ORDER BY name");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $type = new Types($data);
            $types[] = $type;
        }
        return $types;
    }

    public function getTypesById(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM type WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $type = new Types($data);
        return $type;
    }
}
