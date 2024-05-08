<?php

require_once "../models/taskModel.php";
require_once "../models/PDOServer.php";
require_once "../models/productsModel.php";

class TaskManager extends PDOServer
{

    public function addTask(Task $task, Products $products, $idEstimate)
    {
        echo 'Méthode addTask appelée';
        var_dump($task);
        $req = $this->db->prepare("INSERT INTO tasks (description, quantity, unitPrice) VALUES (:description, :quantity, :unitPrice)");
        $req->bindValue(":description", $task->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":quantity", $task->getQuantity(), PDO::PARAM_INT);
        $req->bindValue(":unitPrice", $task->getUnitPrice(), PDO::PARAM_INT);
        $req->execute();
        $temp = $this->db->lastInsertId();
        $req = $this->db->prepare("
            INSERT INTO productbytask (idProduct, idTask, quantityProduct, unitPriceProduct) VALUES (:idProduct, :idTask, :quantityProduct, :unitPriceProduct);
            INSERT INTO taskref (idEstimate, idTask) VALUES ($idEstimate, $temp)"
        );
        $req->bindValue("idProduct", $products->getId(), PDO::PARAM_INT);
        $req->bindValue("idTask", $temp, PDO::PARAM_INT);
        $req->bindValue("quantityProduct", $task->getQuantity(), PDO::PARAM_INT);
        $req->bindValue("unitPriceProduct", $task->getUnitPrice(), PDO::PARAM_INT);
        $req->execute();
    }

        public function addTest () {
        $req = $this->db->query("INSERT INTO tasks (description, quantity, unitPrice) VALUES ('les saucissons', 5, 10) ");
        $req->execute();
    }

}
