<?php
require_once APP_PATH . "/models/customersManager.php";
require_once APP_PATH . "/controller/estimateController.php";
require_once APP_PATH . "/controller/CommonFunctions.php";

class CustomerController extends CommonFunctions
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
        var_dump($_POST);
        if ($_POST) {
            $inputNames = ['nameCustomer', 'adress', 'mailGeneric', 'siren', 'nameContact', 'mailContact', 'adressContact'];
            $xss = $this->xss($inputNames);
            if (gettype($xss) == 'array') {
            }
            /*                 $nameCustomer = $_POST["nameCustomer"];
            $adress = $_POST["adress"];
            $mailGeneric = $_POST["mailGeneric"];
            $siren = $_POST["siren"];
            $nameContact = $_POST["nameContact"];
            $mailContact = $_POST["mailContact"];
            $adressContact = $_POST["adressContact"]; */
            try {
                var_dump($xss);
                $newCustomer = new Customers(
                    $xss
                    /*                     "nameCustomer" => $nameCustomer,
                    "adress" => $adress,
                    "mailGeneric" => $mailGeneric,
                    "siren" => $siren,
                    "nameContact" => $nameContact,
                    "mailContact" => $mailContact,
                    "adressContact" => $adressContact, */
                );
                var_dump($newCustomer);
                $id = $customersManager->addCustomer($newCustomer);
                $customersManager = new CustomersManager();
                $selectedCustomer = $customersManager->getCustomerById($id);
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
