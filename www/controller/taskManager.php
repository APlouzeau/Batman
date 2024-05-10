<?php

require_once "../models/taskModel.php";
require_once "../models/PDOServer.php";
require_once "../models/productsModel.php";

class TaskManager extends PDOServer
{

    public function addTask(Task $task)
    {
        echo 'Méthode addTask appelée';
        $req = $this->db->prepare("INSERT INTO tasks (description, quantity, unitPrice) VALUES (:description, :quantity, :unitPrice)");
        $req->bindValue(":description", $task->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":quantity", $task->getQuantity(), PDO::PARAM_INT);
        $req->bindValue(":unitPrice", $task->getUnitPrice(), PDO::PARAM_INT);
        $req->execute();
        $temp = $this->db->lastInsertId();
        return $temp;
    }

        public function addProductByTask($idEstimate, $idTask, ProductByTask $productByTask, Products $products ){
        $req = $this->db->prepare("INSERT INTO productbytask (idProduct, idTask, quantityProduct, unitPriceProduct) VALUES (:idProduct, :idTask, :quantityProduct, :unitPriceProduct)";   
        $req->bindValue("idProduct", $products->getId(), PDO::PARAM_INT);
        $req->bindValue("idTask", $idTask, PDO::PARAM_INT);
        $req->bindValue("quantityProduct", $productByTask->getQuantityProduct(), PDO::PARAM_INT);
        $req->bindValue("unitPriceProduct", $productByTask->getUnitPriceProduct(), PDO::PARAM_INT);
        $req->execute();
    }

public function addTaskRef ($idEstimate, $idTask) {
    $req = $this->db->query("INSERT INTO taskref (idEstimate, idTask) VALUES ($idEstimate, $idTask)");
}
        public function addTest () {
        $req = $this->db->query("INSERT INTO tasks (description, quantity, unitPrice) VALUES ('les saucissons', 5, 10) ");
        $req->execute();
    }

}
