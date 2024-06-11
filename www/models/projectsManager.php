<?php


class ProjectsManager extends PDOServer
{
    public function projectRegisteredList()
    {
        $req = $this->db->prepare('SELECT nameEstimate, id FROM estimate WHERE imput IS NOT NULL');
        $req->execute();
        $datas = $req->fetchAll();
        $projects = [];
        foreach ($datas as $data) {
            $projects[] = $data;
        }
        var_dump($projects);
        return $projects;
    }

    public function saveSituation(ProductByTask $productByTask)
    {
        $req = $this->db->prepare('UPDATE productbytask SET situation = :situation WHERE idTask = :idTask AND row = :row');
        $req->bindValue(':situation', $productByTask->getSituation(), PDO::PARAM_INT);
        $req->bindValue(':idTask', $productByTask->getIdTask(), PDO::PARAM_INT);
        $req->bindValue(':row', $productByTask->getRow(), PDO::PARAM_INT);
        $req->execute();
    }

    public function expense(ProductByTask $productByTask)
    {
        $req = $this->db->prepare('UPDATE productByTask SET expense = :expense WHERE idTask = :idTask AND row = :row');
        $req->bindValue(':expense', $productByTask->getExpense(), PDO::PARAM_INT);
        $req->bindValue(':idTask', $productByTask->getIdTask(), PDO::PARAM_INT);
        $req->bindValue(':row', $productByTask->getRow(), PDO::PARAM_INT);
        $req->execute();
    }

    public function getTotalProductByProject($idEstimate)
    {
        $req = $this->db->prepare('SELECT idProduct, SUM(expense) AS expense, SUM(quantityProduct) AS quantityProduct, unitPriceProduct FROM productbytask INNER JOIN tasks ON productbytask.idTask = tasks.id WHERE tasks.idEstimate = :idEstimate GROUP BY idProduct');
        $req->bindValue(':idEstimate', $idEstimate, PDO::PARAM_INT);
        $req->execute();
        $products = [];
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $product = new ProductByTask($data);
            $products[] = $product;
        }
        return $products;
    }

    public function getRemainingBudgetPerSituation($idEstimate)
    {
        $req = $this->db->prepare('SELECT idProduct, quantityProduct * unitPriceProduct * situation / 100 - expense AS expense FROM productbytask INNER JOIN tasks ON productbytask.idTask = tasks.id WHERE tasks.idEstimate = :idEstimate GROUP BY idProduct');
        $req->bindValue(':idEstimate', $idEstimate, PDO::PARAM_INT);
        $req->execute();
        $datas = $req->fetchAll();
        $marges = [];
        foreach ($datas as $data) {
            $marge = new ProductByTask($data);
            $marges[] = $marge;
        }
        return $marges;
    }
}
