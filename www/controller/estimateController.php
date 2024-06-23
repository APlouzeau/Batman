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
        $titlePage = 'Devis';
        require_once APP_PATH . "/views/estimate.php";
    }

    public function newEstimatePage()
    {
        if ($_SESSION['role'] != 'Assistant') {
            $customersManager = new CustomersManager();
            $selectedCustomer = $customersManager->getCustomerById($_GET["id"]);
            $nameCustomer = $selectedCustomer->getNameCustomer();
            $contactCustomer = $selectedCustomer->getNameContact();
            $mailContact = $selectedCustomer->getMailContact();
            $adressContact = $selectedCustomer->getAdressContact();
            $titlePage = 'Nouveau devis';
            require_once APP_PATH . "/views/newEstimate.php";
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }
    public function newEstimate()
    {
        $estimateManager = new EstimateManager();
        if ($_GET && $_SESSION['role'] != 'Assistant' && $_GET['csrf_token'] == $_SESSION['csrf_token']) {
            $nameEstimate = $_GET["nameEstimate"];
            $idCustomer = $_GET["id"];
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
                $productList = $productsManager->showAllProducts();
                $taskManager = new TaskManager();
                $tasksList = $taskManager->showTasksById($estimate->getId());
                $rowCount = 0;
                $titlePage = 'Edition devis';
                require_once APP_PATH . "/views/modifyEstimate.php";
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function saveEstimate()
    {
        ($_POST);
        if (
            $_POST &&
            $_SESSION['role'] != 'Assistant' &&
            $_POST['csrf_token'] == $_SESSION['csrf_token']
        ) {
            $taskManager = new TaskManager();
            $productsManager = new ProductsManager();
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
                            'quantityProduct' => strval($_POST['quantity' . $i][$j]),
                            'unitPriceProduct' => $_POST['unitPrice' . $i][$j],
                            'row' => $_POST['row' . $i][$j],
                            'unit' => $_POST['unit' . $i][$j],
                        ]);
                        $taskManager->addProductByTask($idTask, $newProductByTask, $newProducts);
                        $j++;
                    }
                }
                $this->modifyEstimate();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function searchEstimateToModify()
    {
        if ($_SESSION['role'] != 'Assistant') {
            $estimateManager = new EstimateManager();
            try {
                $estimateList = $estimateManager->showEstimateToModify();
            } catch (Exception $e) {
                error_log('Erreur : ' . $e->getMessage());
            }
            $titlePage = 'Recherche de devis';
            require_once APP_PATH . '/views/searchEstimate.php';
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function modifyEstimate()
    {
        $estimateManager = new EstimateManager();
        if ($_SESSION['role'] != 'Assistant') {
            if ($_POST) {
                $estimate = $estimateManager->showEstimateById($_POST['idEstimate']);
            } else {
                $estimate = $estimateManager->showEstimateById($_GET['idEstimate']);
            };
            $productsManager = new ProductsManager();
            $productList = $productsManager->showAllProducts();
            $typesManager = new TypesManager();
            $typesList = $typesManager->showTypes();
            $taskManager = new TaskManager();
            $productByTaskManager = new productByTaskManager();
            $tasksList = $taskManager->showTasksById($estimate->getId());
            $rowCount = 0;
            foreach ($tasksList as $taskDetails) {
                $productsByTask = $taskManager->getProductsByTask($taskDetails['id']);
                foreach ($productsByTask as $productByTask) {
                    $rowCount++;
                }
            }
            $titlePage = 'Edition devis';
            require_once APP_PATH . '/views/modifyEstimate.php';
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function updateEstimate()
    {
        if ($_SESSION['role'] != 'Assistant') {
            if (isset($_POST['controlUpdate']) && $_POST['controlUpdate'] == 'update') {
                $taskManager = new TaskManager();
                $tasksList = $taskManager->showTasksById($_POST['idEstimate']);
                if ($_POST) {
                    if (!empty($tasksList)) {
                        try {
                            foreach ($tasksList as $tasksId) {
                                $idTasks[] = $tasksId['id'];
                            }
                            $taskManager->deleteTasks($idTasks);
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                        }
                    }
                    $this->saveEstimate();
                }
            } else {
                $this->modifyEstimate();
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function accountingPage()
    {
        if ($_SESSION['role'] == 'Comptable' || $_SESSION['role'] == 'Administrateur') {
            $titlePage = 'Comptabilité';
            require_once APP_PATH . "/views/accounting.php";
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function estimateToRegister()
    {
        if ($_SESSION['role'] == 'Comptable' || $_SESSION['role'] == 'Administrateur') {
            $estimateManager = new EstimateManager();
            $estimateList = $estimateManager->showEstimateToModify();
            $userManager = new UserManager();
            $driverList = $userManager->getDrivers();
            $titlePage = 'Devis à enregistrer';
            require_once APP_PATH . "/views/estimateToRegister.php";
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function registerEstimate()
    {
        if (($_SESSION['role'] == 'Comptable' || $_SESSION['role'] == 'Administrateur') && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            $estimateManager = new EstimateManager();
            $estimateManager->registerEstimate($_POST["id"], $_POST["driver"]);
            $this->accountingPage();
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function estimateRegistered()
    {
        if ($_SESSION['role'] == 'Comptable' || $_SESSION['role'] == 'Administrateur') {
            $estimateManager = new EstimateManager();
            $estimateList = $estimateManager->showEstimateRegistered();
            $titlePage = 'Devis enregistrés';
            require_once APP_PATH . "/views/estimateRegistered.php";
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }
}
