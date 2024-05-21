<?php

require_once APP_PATH . "/models/PDOServer.php";
require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/typesManager.php";
require_once APP_PATH . "/models/productsManager.php";

class estimateController
{

    public function estimate()
    {
        require_once APP_PATH . "/views/estimate.php";
    }

    public function newEstimatePage()
    {
        $customersManager = new CustomersManager();
        $selectedCustomer = $customersManager->getCustomerById($_GET["id"]);
        $nameCustomer = $selectedCustomer->getNameCustomer();
        $contactCustomer = $selectedCustomer->getNameContact();
        $mailContact = $selectedCustomer->getMailContact();
        $adressContact = $selectedCustomer->getAdressContact();
        require_once APP_PATH . "/views/newEstimate.php";
    }
    public function newEstimate()
    {
        $estimateManager = new EstimateManager();

        if ($_POST) {
            $nameEstimate = $_POST["nameEstimate"];
            $idCustomer = $_POST["id"];
            try {
                $newEstimate = new Estimate([
                    "nameEstimate" => $nameEstimate,
                    "idCustomer" => $idCustomer,
                ]);
                $idEstimate = $estimateManager->createEstimate($newEstimate);
                $estimate = $estimateManager->showEstimateById($idEstimate);
                $typesManager = new TypesManager();
                $typesList = $typesManager->showTypes();
                $productsManager = new ProductsManager();
                $productList = $productsManager->showProducts();
                require_once APP_PATH . "/views/createEstimate.php";
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }

    public function createEstimate()
    {
        $estimateManager = new EstimateManager();
        $taskManager = new TaskManager();
        $productByTaskManager = new productByTaskManager();
        $tasksNumber = 1;
        var_dump($_POST);

        if ($_POST) {
            $idEstimate = $_GET['id'];
            try {
                $count = floor(count($_POST) / 4);
                for ($i = 0; $i < $count; $i++) {
                    $newTask = new Task([
                        'taskNumber' => $_POST['taskNumber' . $i][0],
                        'descriptionTask' => $_POST["description" . $i][0],
                        /* 'quantity' => $_POST["quantity" . $i],
    'unitPrice' => $_POST["unitPrice" . $i] */
                    ]);
                    $idTask = $taskManager->addTask($newTask);
                    $taskManager->addTaskRef($idEstimate, $idTask);
                    $j = 0;
                    foreach ($_POST['product' . $i] as $value) {
                        $product = $productsManager->getProductsByName($_POST['product' . $i][$j]);
                        $newProducts = new Products([
                            'id' => $product->getId()
                        ]);
                        $newProductByTask = new ProductByTask([
                            'quantityProduct' => $_POST['quantity' . $i][$j],
                            'unitPriceProduct' => $_POST['unitPrice' . $i][$j],
                        ]);
                        $taskManager->addProductByTask($idTask, $newProductByTask, $newProducts);
                        $j++;
                    }
                } /* header("Location:modifyEstimate.php?id=$estimateId"); */
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
}
