<?php

require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/typesManager.php";
require_once APP_PATH . "/models/productsManager.php";
require_once APP_PATH . "/models/taskManager.php";
require_once APP_PATH . "/models/productByTaskManager.php";
require_once APP_PATH . "/models/userManager.php";

class EstimateController
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

    public function saveEstimate()
    {
        $taskManager = new TaskManager();
        $productByTaskManager = new productByTaskManager();
        $productsManager = new ProductsManager();
        if ($_POST) {
            try {
                $result = 0;
                $search = 'description';
                foreach ($_POST as $key => $value) {
                    if (substr_count($key, $search) == 1) {
                        $result++;
                    }
                }
                for ($i = 0; $i < $result; $i++) {
                    $newTask = new Task([
                        'idEstimate' => $_POST['idEstimate'],
                        'taskNumber' => $_POST['taskNumber' . $i],
                        'descriptionTask' => $_POST["description" . $i],
                    ]);
                    $idTask = $taskManager->addTask($newTask);
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
                }
                $this->modifyEstimate();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }

    public function searchEstimateToModify()
    {
        $estimateManager = new EstimateManager();
        try {
            $estimateList = $estimateManager->showEstimateToModify();
        } catch (Exception $e) {
            error_log('Erreur : ' . $e->getMessage());
        }
        require_once APP_PATH . '/views/searchEstimate.php';
    }

    public function modifyEstimate()
    {
        $estimateManager = new EstimateManager();
        if ($_POST) {
            $estimate = $estimateManager->showEstimateById($_POST['idEstimate']);
        } else {
            $estimate = $estimateManager->showEstimateById($_GET['idEstimate']);
        };
        $productsManager = new ProductsManager();
        $productList = $productsManager->showProducts();
        $typesManager = new TypesManager();
        $typesList = $typesManager->showTypes();
        $taskManager = new TaskManager();
        $productByTaskManager = new productByTaskManager();
        $tasksList = $taskManager->showTasksById($estimate->getId());
        require_once APP_PATH . '/views/modifyEstimate.php';
    }

    public function updateEstimate()
    {
        echo 'appel de updateEstimate';
        if (isset($_POST['toto']) && $_POST['toto'] == 'update') {
            var_dump($_POST);
            $taskManager = new TaskManager();
            $tasksList = $taskManager->showTasksById($_POST['idEstimate']);
            if ($_POST) {
                if (!empty($tasksList)) {
                    try {
                        echo 'début de la boucle';
                        foreach ($tasksList as $tasksId) {
                            $idTasks[] = $tasksId['id'];
                        }
                        $taskManager->deleteTasks($idTasks);
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                    }
                }
                echo 'appel de saveestimate';
                $this->saveEstimate();

                /*             try {
                $count = count($_POST) / 4;
                for ($i = 0; $i < $count; $i++) {
                    $newTask = new Task([
                        'description' => $_POST["description" . $i][0],
                        'quantity' => $_POST["quantity" . $i],
                        'unitPrice' => $_POST["unitPrice" . $i]
                    ]);
                    $idTask = $taskManager->addTask($newTask);
                    var_dump($idTask);
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
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            } */
            }
        } else {
            $this->modifyEstimate();
        }
    }

    public function accountingPage()
    {
        require_once APP_PATH . "/views/accounting.php";
    }

    public function estimateToRegister()
    {
        $estimateManager = new EstimateManager();
        $estimateList = $estimateManager->showEstimateToModify();
        $userManager = new UserManager();
        $driverList = $userManager->getDrivers();
        require_once APP_PATH . "/views/estimateToRegister.php";
    }

    public function registerEstimate()
    {
        $estimateManager = new EstimateManager();
        $estimateManager->registerEstimate($_POST["id"], $_POST["driver"]);
        $this->accountingPage();
    }

    public function estimateRegistered()
    {
        $estimateManager = new EstimateManager();
        $estimateList = $estimateManager->showEstimateRegistered();
        require_once APP_PATH . "/views/estimateRegistered.php";
    }
}
