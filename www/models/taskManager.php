<?php

require_once APP_PATH . "/../models/taskModel.php";
require_once APP_PATH . "/../models/PDOServer.php";
require_once APP_PATH . "/../models/productsModel.php";

class TaskManager extends PDOServer
{

    public function addTask(Task $task)
    {
        $req = $this->db->prepare("INSERT INTO tasks (taskNumber, descriptionTask, quantity, unitPrice) VALUES (:taskNumber, :descriptionTask, :quantity, :unitPrice)");
        $req->bindValue(":taskNumber", $task->getTaskNumber(), PDO::PARAM_INT);
        $req->bindValue(":descriptionTask", $task->getDescriptionTask(), PDO::PARAM_STR);
        $req->bindValue(":quantity", $task->getQuantity(), PDO::PARAM_INT);
        $req->bindValue(":unitPrice", $task->getUnitPrice(), PDO::PARAM_INT);
        $req->execute();
        $temp = $this->db->lastInsertId();
        return $temp;
    }

        public function addProductByTask($idTask, ProductByTask $productByTask, Products $products ){
        $req = $this->db->prepare("INSERT INTO productbytask (idProduct, idTask, quantityProduct, unitPriceProduct) VALUES (:idProduct, :idTask, :quantityProduct, :unitPriceProduct)");   
        $req->bindValue("idProduct", $products->getId(), PDO::PARAM_INT);
        $req->bindValue("idTask", $idTask, PDO::PARAM_INT);
        $req->bindValue("quantityProduct", $productByTask->getQuantityProduct(), PDO::PARAM_INT);
        $req->bindValue("unitPriceProduct", $productByTask->getUnitPriceProduct(), PDO::PARAM_INT);
        $req->execute();
    }

    public function addTaskRef ($idEstimate, $idTask) {
        $this->db->query("INSERT INTO taskref (idEstimate, idTask) VALUES ($idEstimate, $idTask)");
    }
    public function addTest () {
        $req = $this->db->query("INSERT INTO tasks (descriptionTask, quantity, unitPrice) VALUES ('les saucissons', 5, 10) ");
        $req->execute();
    }

    public function updateTasks (Task $task) {
        $req = $this->db->prepare("UPDATE tasks SET descriptionTask = :descriptionTask, quantity = :quantity, unitPrice = :unitPrice)");
        $req->bindValue(":description", $task->getDescriptionTask(), PDO::PARAM_STR);
        $req->bindValue(":quantity", $task->getQuantity(), PDO::PARAM_INT);
        $req->bindValue(":unitPrice", $task->getUnitPrice(), PDO::PARAM_INT);
        $req->execute();
        $temp = $this->db->lastInsertId();
        return $temp;
    }

    public function updateProductByTask($idTask, ProductByTask $productByTask, Products $products ){
        $req = $this->db->prepare("UPDATE productbytask SET idProduct = :idProduct, idTask = :idTask, quantityProduct = :quantityProduct, unitPrice = :unitPriceProduct)");   
        $req->bindValue("idProduct", $products->getId(), PDO::PARAM_INT);
        $req->bindValue("idTask", $idTask, PDO::PARAM_INT);
        $req->bindValue("quantityProduct", $productByTask->getQuantityProduct(), PDO::PARAM_INT);
        $req->bindValue("unitPriceProduct", $productByTask->getUnitPriceProduct(), PDO::PARAM_INT);
        $req->execute();
    }

    public function showTasksById ($idEstimate) {
        $req = $this->db->query("SELECT * FROM tasks 
                                INNER JOIN taskref ON taskref.idTask = tasks.id 
                                WHERE taskref.idEstimate = $idEstimate                        
                                ");
        $datas = $req->fetchAll();
        return $datas;
    }

    public function getProductsByTask($idTask) {
        $req = $this->db->query("SELECT * FROM productByTask WHERE idTask = $idTask");
        $datas = $req->fetchAll();
        return $datas;
    }

    public function deleteTasks(array $idTasks) {
        foreach ($idTasks as $idTask) {
            $this->db->query("DELETE FROM tasks WHERE id = $idTask");
        }
    }

}



/* SELECT DISTINCT tasks.*, productbytask.*, products.* 
                                FROM tasks 
                                INNER JOIN productbytask ON tasks.id = productbytask.idTask 
                                INNER JOIN taskref ON taskref.idEstimate = $idEstimate
                                INNER JOIN products ON productbytask.idProduct = products.id */
