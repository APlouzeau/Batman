<?php
require_once APP_PATH . "/models/projectsManager.php";
require_once APP_PATH . "/models/estimateManager.php";
class ProjectsController
{

    public function projectsPage()
    {
        $projectsManager = new ProjectsManager;
        $projectList = $projectsManager->projectRegisteredList();
        require_once APP_PATH . "/views/projects.php";
    }

    public function editSituationPage()
    {
        if ($_SESSION['role'] != 'Assistant') {
            $estimateManager = new EstimateManager();
            $estimate = $estimateManager->showEstimateById($_GET['id']);
            $taskManager = new TaskManager();
            $tasksList = $taskManager->showTasksById($_GET['id']);
            $productsManager = new ProductsManager();
            $productList = $productsManager->showProducts();
            $typesManager = new TypesManager();
            $typesList = $typesManager->showTypes();
            $productByTaskManager = new productByTaskManager();
            require_once APP_PATH . "/views/editSituation.php";
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function saveSituation()
    {
        if ($_POST && $_SESSION['role'] != 'Assistant') {
            var_dump($_POST);
            $result = 0;
            $search = 'taskId';
            foreach ($_POST as $key => $value) {
                if (substr_count($key, $search) == 1) {
                    $result++;
                }
            }
            var_dump($result);
            try {
                $projectManager = new ProjectsManager();
                for ($i = 0; $i < $result; $i++) {
                    $j = 0;
                    foreach ($_POST['situation' . $i] as $value) {
                        $newSituationByProduct = new ProductByTask([
                            'idTask' => $_POST['taskId' . $i],
                            'situation' => $_POST['situation' . $i][$j],
                            'row' => $_POST['row' . $i][$j]
                        ]);
                        $projectManager->saveSituation($newSituationByProduct);
                        $j++;
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function orderPage()
    {
        if ($_POST && $_SESSION['role'] != 'Assistant') {
            $estimateManager = new EstimateManager();
            $estimate = $estimateManager->showEstimateById($_GET['id']);
            $taskManager = new TaskManager();
            $tasksList = $taskManager->showTasksById($_GET['id']);
            $productsManager = new ProductsManager();
            $productList = $productsManager->showProducts();
            $typesManager = new TypesManager();
            $typesList = $typesManager->showTypes();
            $productByTaskManager = new productByTaskManager();
            require_once APP_PATH . "/views/order.php";
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function saveOrder()
    {
        if ($_POST && $_SESSION['role'] != 'Assistant') {
            $result = 0;
            $search = 'taskId';
            foreach ($_POST as $key => $value) {
                if (substr_count($key, $search) == 1) {
                    $result++;
                }
            }
            try {
                $projectManager = new ProjectsManager();
                for ($i = 0; $i < $result; $i++) {
                    $j = 0;
                    foreach ($_POST['expense' . $i] as $value) {
                        $row = (is_numeric($_POST['row' . $i][$j]) ? (int)$_POST['row' . $i][$j] : 0);
                        $expense = (is_numeric($_POST['expense' . $i][$j]) ? (int)$_POST['expense' . $i][$j] : 0);
                        $newProductByTask = new ProductByTask([
                            'idTask' => $_POST['taskId' . $i],
                            'row' => $row,
                            'expense' => $expense,
                        ]);
                        $j++;
                        $projectManager->expense($newProductByTask);
                    }
                }
            } catch (Exception $e) {
                $e->getMessage();
            }
            $this->projectsPage();
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function resultsPage()
    {
        $estimateManager = new EstimateManager();
        $estimate = $estimateManager->showEstimateById($_GET['id']);
        $tasksManager = new TaskManager();
        $tasksList = $tasksManager->showTasksById($_GET['id']);
        $productsManager = new ProductsManager();
        $projectsManager = new ProjectsManager();
        $productsResultList = $projectsManager->getTotalProductByProject($_GET['id']);
        $marges = $projectsManager->getRemainingBudgetPerSituation($_GET['id']);
        require_once APP_PATH . "/views/results.php";
    }

    public function totalBudget(ProductByTask $productByTask)
    {
        return $productByTask->getQuantityProduct() * $productByTask->getUnitPriceProduct();
    }

    public function projectedExpense(ProductByTask $productByTask)
    {
        return $this->totalBudget($productByTask) * $productByTask->getSituation() / 100;
    }

    public function remainingBudget(ProductByTask $productByTask)
    {
        return $this->totalBudget($productByTask) - $this->projectedExpense($productByTask);
    }

    public function margin()
    {
        $projectsManager = new ProjectsManager();
        $test =  $projectsManager->getRemainingBudgetPerSituation($_GET('id'));
    }

    public function projectedBudget(ProductByTask $productByTask)
    {
        return $this->totalBudget($productByTask) * $productByTask->getSituation() / 100;
    }

    public function getMarge(ProductByTask $productByTask, array $marges)
    {
        foreach ($marges as $marge) {
            if ($productByTask->getIdProduct() == $marge->getIdProduct()) {
                return $marge->getExpense();
            }
        }
    }
}
