<?php

require_once APP_PATH . "/models/estimateModel.php";
require_once APP_PATH . "/models/PDOServer.php";
class EstimateManager extends PDOServer
{

    public function createEstimate(Estimate $estimate)
    {
        $req = $this->db->prepare("INSERT INTO estimate (nameEstimate, idCustomer) VALUE (:nameEstimate, :idCustomer)");
        $req->bindValue(":nameEstimate", $estimate->getNameEstimate(), PDO::PARAM_STR);
        $req->bindValue(":idCustomer", $estimate->getIdCustomer(), PDO::PARAM_STR);
        $req->execute();
        $temp = $this->db->lastInsertId();
        return $temp;
    }

    public function getEstimateIdByName($nameEstimate)
    {
        $req = $this->db->prepare("SELECT * FROM estimate WHERE nameEstimate = :nameEstimate");
        $req->bindValue(":nameEstimate", $nameEstimate, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch();
        $estimate = new Estimate($data);
        return $estimate;
    }

    public function showEstimateToModify()
    {
        $estimates = [];
        $req = $this->db->query("SELECT * FROM estimate WHERE registered = 'non' ORDER BY date");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $estimate = new Estimate($data);
            $estimates[] = $estimate;
        }
        return $estimates;
    }

    public function showEstimateById($id)
    {
        $req = $this->db->query("SELECT * FROM estimate WHERE id = $id");
        $data = $req->fetch();
        $estimate = new Estimate($data);
        return $estimate;
    }

    public function registerEstimate($idEstimate)
    {
        $req = $this->db->query("UPDATE estimate SET registered = 'oui' WHERE id = $idEstimate");
        $req->execute();
    }
}
