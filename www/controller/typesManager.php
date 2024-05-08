<?php

require_once "../models/typesModel.php";
require_once "../models/PDOServer.php";
class TypesManager extends PDOServer
{

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
