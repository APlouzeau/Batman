<?php

require_once "../models/estimateModel.php";
require_once "../models/PDOServer.php";
class EstimateManager extends PDOServer
{

    public function createEstimate(Estimate $estimate)
    {
        $req = $this->db->prepare("INSERT INTO estimate (nameEstimate, idCustomer) VALUE (:nameEstimate, :idCustomer)");
        $req->bindValue(":nameEstimate", $estimate->getNameEstimate(), PDO::PARAM_STR);
        $req->bindValue(":idCustomer", $estimate->getIdCustomer(), PDO::PARAM_STR);
        $req->execute();
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
}
