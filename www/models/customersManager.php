<?php

require_once APP_PATH . "/models/entities/customersModel.php";
require_once APP_PATH . "/models/entities/PDOServer.php";

class CustomersManager extends PDOServer
{

    public function addCustomer(Customers $customer)
    {
        $req = $this->db->prepare("INSERT INTO customer (nameCustomer, adress, mailGeneric, siren, nameContact, mailContact, adressContact) VALUE (:nameCustomer, :adress, :mailGeneric, :siren, :nameContact, :mailContact, :adressContact)");
        $req->bindValue(":nameCustomer", $customer->getNameCustomer(), PDO::PARAM_STR);
        $req->bindValue(":adress", $customer->getAdress(), PDO::PARAM_STR);
        $req->bindValue(":mailGeneric", $customer->getMailGeneric(), PDO::PARAM_STR);
        $req->bindValue(":siren", $customer->getSiren(), PDO::PARAM_INT);
        $req->bindValue(":nameContact", $customer->getNameContact(), PDO::PARAM_STR);
        $req->bindValue(":mailContact", $customer->getMailContact(), PDO::PARAM_STR);
        $req->bindValue(":adressContact", $customer->getAdressContact(), PDO::PARAM_STR);
        $req->execute();
    }

    public function getAllCustomers()
    {
        $customers = [];
        $req = $this->db->query("SELECT * FROM customer");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $customer = new Customers($data);
            $customers[] = $customer;
        }
        return $customers;
    }

    public function getCustomerById($id)
    {
        $req = $this->db->prepare("SELECT * FROM customer WHERE id = :id");
        $req->bindValue("id", $id, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch();
        $customer = new Customers($data);
        return $customer;
    }

    public function getCustomersbyName($nameCustomer)
    {
        $req = $this->db->prepare("SELECT * FROM customer WHERE  nameCustomer = :nameCustomer");
        $req->bindValue("nameCustomer", $nameCustomer, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch();
        $customer = new Customers($data);
        return $customer;
    }
}
