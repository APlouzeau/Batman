<?php

require_once "../models/customersModel.php";

class CustomersManager
{
    private $db;

    public function __construct()
    {
        $dbName = "sopeyo";
        $port = "3306";
        $userName = "root";
        try {
            $this->db = new PDO("mysql:host=localhost; dbname=$dbName; port=$port", $userName, "");
            echo "La connextion à la base de donnée à réussi.";
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "La connexion à la base de donnée a échouée.";
        }
    }

    public function addCustomer(Customers $customer)
    {
        echo 'coucou';
        $req = $this->db->prepare("INSERT INTO customer (name, adress, mailGeneric, siren, nameContact, mailContact, adressContact) VALUE (:name, :adress, :mailGeneric, :siren, :nameContact, :mailContact, :adressContact)");
        $req->bindValue(":name", $customer->getName(), PDO::PARAM_STR);
        $req->bindValue(":adress", $customer->getAdress(), PDO::PARAM_STR);
        $req->bindValue(":mailGeneric", $customer->getMailGeneric(), PDO::PARAM_STR);
        $req->bindValue(":siren", $customer->getSiren(), PDO::PARAM_INT);
        $req->bindValue(":nameContact", $customer->getNameContact(), PDO::PARAM_STR);
        $req->bindValue(":mailContact", $customer->getMailContact(), PDO::PARAM_STR);
        $req->bindValue(":adressContact", $customer->getAdressContact(), PDO::PARAM_STR);
        $req->execute();
        echo 'LE client a été ajouté)';
    }
}
