<?php
require_once APP_PATH . "/models/customersManager.php";
require_once APP_PATH . "/controller/estimateController.php";
require_once APP_PATH . "/controller/commonFunctions.php";

class CustomerController
{

    public function searchCustomer()
    {
        $customerController = new CustomerController();
        $customerList = $this->showAllCustomers();
        $titlePage = 'Recherche de client';
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
        if ($_POST && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            $inputNames = [
                'nameCustomer',
                'adress',
                'mailGeneric',
                'siren',
                'nameContact',
                'mailContact',
                'adressContact'
            ];
            $xss = xss($inputNames);
            if (gettype($xss) == 'array') {
                try {
                    $newCustomer = new Customers($xss);
                    $id = $customersManager->addCustomer($newCustomer);
                    $customersManager = new CustomersManager();
                    $selectedCustomer = $customersManager->getCustomerById($id);
                    $nameCustomer = $selectedCustomer->getNameCustomer();
                    $contactCustomer = $selectedCustomer->getNameContact();
                    $mailContact = $selectedCustomer->getMailContact();
                    $adressContact = $selectedCustomer->getAdressContact();
                    $titlePage = 'Nouveau devis';
                    require_once APP_PATH . "/views/newEstimate.php";
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }
    }
}
