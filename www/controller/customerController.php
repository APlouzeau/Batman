<?php
require_once APP_PATH . "/models/PDOServer.php";
require_once APP_PATH . "/models/customersManager.php";

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
}
