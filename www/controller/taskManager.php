<?php

require_once "../models/taskModel.php";
require_once "../models/PDOServer.php";
class TaskManager extends PDOServer
{

    public function addTask(Task $task)
    {
        $req = $this->db->prepare("INSERT INTO tasks (lineNb, description, quantity, unitPrice VALUE (:lineNb, :description, :quantity, :unitPrice");
        $req->bindValue(":lineNb", $task->getLineNumber(), PDO::PARAM_INT);
        $req->bindValue(":description", $task->getDescription(), PDO::PARAM_INT);
        $req->bindValue(":quantity", $task->getQuantity(), PDO::PARAM_INT);
        $req->bindValue(":unitPrice", $task->getUnitPrice(), PDO::PARAM_INT);
        $req->execute();
    }
}
