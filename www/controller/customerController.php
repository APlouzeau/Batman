<?php
require_once APP_PATH . "/models/customersManager.php";
require_once APP_PATH . "/controller/estimateController.php";

class CustomerController
{

    public function searchCustomer()
    {
        $customerController = new CustomerController();
        $customerList = $this->showAllCustomers();
        require_once APP_PATH . "/views/searchCustomer.php";
    }
    public function showAllCustomers()
    {
        $customerManager = new CustomersManager();
        $customerList = $customerManager->getAllCustomers();
        return $customerList;
    }

    public function addCustomer()
    {
        $customersManager = new CustomersManager();

        if ($_POST) {
            $nameCustomer = $_POST["nameCustomer"];
            $adress = $_POST["adress"];
            $mailGeneric = $_POST["mailGeneric"];
            $siren = $_POST["siren"];
            $nameContact = $_POST["nameContact"];
            $mailContact = $_POST["mailContact"];
            $adressContact = $_POST["adressContact"];
            try {
                $newCustomer = new Customers([
                    "nameCustomer" => $nameCustomer,
                    "adress" => $adress,
                    "mailGeneric" => $mailGeneric,
                    "siren" => $siren,
                    "nameContact" => $nameContact,
                    "mailContact" => $mailContact,
                    "adressContact" => $adressContact,
                ]);
                $customersManager->addCustomer($newCustomer);
                $customersId = $customersManager->getCustomersbyName($nameCustomer);
                $getId = $customersId->getId();
                $customersManager = new CustomersManager();
                $selectedCustomer = $customersManager->getCustomerById($getId);
                $nameCustomer = $selectedCustomer->getNameCustomer();
                $contactCustomer = $selectedCustomer->getNameContact();
                $mailContact = $selectedCustomer->getMailContact();
                $adressContact = $selectedCustomer->getAdressContact();
                require_once APP_PATH . "/views/newEstimate.php";
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
}
