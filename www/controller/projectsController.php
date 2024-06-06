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
    }

    public function saveSituation()
    {
        if ($_POST) {
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
        }
    }

    public function orderPage()
    {
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
    }

    public function saveOrder()
    {
        if ($_POST) {
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
        }
    }
}
