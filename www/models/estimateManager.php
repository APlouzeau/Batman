<?php

require_once APP_PATH . "/models/entities/estimateModel.php";
require_once APP_PATH . "/models/entities/PDOServer.php";
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
        $req = $this->db->query("SELECT * FROM estimate WHERE imput IS NULL ORDER BY date");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $estimate = new Estimate($data);
            $estimates[] = $estimate;
        }
        return $estimates;
    }

    public function showEstimateById($id)
    {
        $req = $this->db->prepare("SELECT * FROM estimate WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $estimate = new Estimate($data);
        return $estimate;
    }

    public function registerEstimate($idEstimate, string $driver)
    {
        $prefix = date("ym");
        $req = $this->db->prepare("SELECT * FROM estimate WHERE imput LIKE :prefix");
        $req->bindValue(":prefix", $prefix . '%', PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetchAll();
        $imput = sprintf(strval($prefix) . "%'.03d", strval(count($data)) + 1);
        $req = $this->db->prepare("UPDATE estimate SET driver = :driver, imput = :imput WHERE id = :idEstimate");
        $req->bindValue(":driver", $driver, PDO::PARAM_INT);
        $req->bindValue(":imput", $imput, PDO::PARAM_STR);
        $req->bindValue(":idEstimate", $idEstimate, PDO::PARAM_INT);
        $req->execute();
    }

    public function showEstimateRegistered()
    {
        $estimates = [];
        $req = $this->db->query("SELECT * FROM estimate WHERE imput IS NOT NULL ORDER BY date");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $estimate = new Estimate($data);
            $estimates[] = $estimate;
        }
        return $estimates;
    }
}
