<?php
require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/typesManager.php";
require_once APP_PATH . "/models/productsManager.php";

class ProductController extends CommonFunctions
{

    public function createProduct()
    {
        $productsManager = new ProductsManager();
        if ($_POST && ($_SESSION['role'] != 'Assistant' && $_SESSION['role'] != 'Comptable')) {
            $inputNames = ['name', 'type', 'length', 'recovery', 'summary', 'descriptionProduct', 'price', 'unit'];
            $xss = $this->xss($inputNames);
            if (gettype($xss) == 'array') {
                /* $xss = [
                    "name" => htmlspecialchars($_POST["name"], ENT_NOQUOTES),
                    "type" => htmlspecialchars($_POST["type"], ENT_NOQUOTES),
                "length" => htmlspecialchars($_POST["length"], ENT_NOQUOTES),
                "recovery" => htmlspecialchars($_POST["recovery"], ENT_NOQUOTES),
                "summary" => htmlspecialchars($_POST["summary"], ENT_NOQUOTES),
                "descriptionProduct" => htmlspecialchars($_POST["descriptionProduct"], ENT_NOQUOTES),
                "price" => htmlspecialchars($_POST["price"], ENT_NOQUOTES),
                "unit" => htmlspecialchars($_POST['unit'], ENT_NOQUOTES)
                ];
            var_dump($xss); */
                /*  $product = [];
            $counter = 0;
            foreach ($xss as $key => $value) {
                if ($value == $_POST[$key]) {
                    $product[$key] = $value;
                    $counter++;
                    if ($counter == count($xss)) {
                        var_dump($product); */
                try {
                    $newProduct = new Products($xss);
                    $productsManager->addProducts($newProduct);
                    echo "L'ajout a réussi.";
                    $this->products();
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }



    public function products()
    {
        $productsManager = new ProductsManager();
        $rollList = $productsManager->showProducts();
        $typesManager = new TypesManager();
        $typesList = $typesManager->showTypes();
        require_once APP_PATH . '/views/products.php';
    }
    public function details()
    {
        $productsManager = new ProductsManager();
        $roll = $productsManager->getProductsById($_GET["id"]);
        require_once APP_PATH . '/views/detailsProducts.php';
    }

    public function modifyProductPage()
    {
        if ($_GET && $_SESSION['role'] == 'Administrateur') {
            $productsManager = new ProductsManager();
            $product = $productsManager->getProductsById($_GET["id"]);
            $typesManager = new TypesManager();
            $typesList = $typesManager->showTypes();
            require_once APP_PATH . '/views/modifyProducts.php';
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function modifyProduct()
    {
        if ($_POST && $_SESSION['role'] == 'Administrateur') {
            $productsManager = new ProductsManager();
            $product = $productsManager->getProductsById($_GET["id"]);
            $typesManager = new TypesManager();
            $typesList = $typesManager->showTypes();

            if ($_POST) {
                $id = $product->getId();
                $name = $_POST["name"];
                $type = $_POST["type"];
                $length = $_POST["length"];
                $recovery = $_POST["recovery"];
                $summary = $_POST["summary"];
                $descriptionProduct = $_POST["descriptionProduct"];
                $price = $_POST["price"];
                $unit = $_POST["unit"];
                try {
                    $updateProduct = new Products([
                        "id" => $id,
                        "name" => $name,
                        "type" => $type,
                        "length" => $length,
                        "recovery" => $recovery,
                        "summary" => $summary,
                        "descriptionProduct" => $descriptionProduct,
                        "price" => $price,
                        "unit" => $unit,
                    ]);
                    $productsManager->updateProducts($updateProduct, $id);
                    $this->products();
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function deleteProduct()
    {
        if ($_GET && $_SESSION['role'] == 'Administrateur') {
            $productsManager = new ProductsManager();
            $productsManager->deleteProducts($_GET["id"]);
            $this->products();
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }
}
