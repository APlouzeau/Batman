<?php

require_once APP_PATH . "/models/PDOServer.php";
require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/typesManager.php";
require_once APP_PATH . "/models/productsManager.php";

class ProductController
{

    public function products()
    {
        $productsManager = new ProductsManager();
        $rollList = $productsManager->showProducts();
        $typesManager = new TypesManager();
        $typesList = $typesManager->showTypes();
        require_once APP_PATH . '/views/products.php';
    }
    public function createProduct()
    {
        $productsManager = new ProductsManager();
        if ($_POST) {
            $name = $_POST["name"];
            $type = $_POST["type"];
            $length = $_POST["length"];
            $recovery = $_POST["recovery"];
            $summary = $_POST["summary"];
            $descriptionProduct = $_POST["descriptionProduct"];
            $price = $_POST["price"];
            try {
                $newProduct = new Products([
                    "name" => $name,
                    "type" => $type,
                    "length" => $length,
                    "recovery" => $recovery,
                    "summary" => $summary,
                    "descriptionProduct" => $descriptionProduct,
                    "price" => $price,
                ]);
                $productsManager->addProducts($newProduct);
                echo "L'ajout a réussi.";
                $this->products();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }

    public function details()
    {
        $productsManager = new ProductsManager();
        $roll = $productsManager->getProductsById($_GET["id"]);
        require_once APP_PATH . '/views/detailsProducts.php';
    }


    public function modifyProductPage()
    {
        $productsManager = new ProductsManager();
        $product = $productsManager->getProductsById($_GET["id"]);
        $typesManager = new TypesManager();
        $typesList = $typesManager->showTypes();
        require_once APP_PATH . '/views/modifyProducts.php';
    }

    public function modifyProduct()
    {
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
                ]);
                $productsManager->updateProducts($updateProduct, $id);
                $this->products();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }

    public function deleteProduct()
    {
        $productsManager = new ProductsManager();
        $productsManager->deleteProducts($_GET["id"]);
        $this->products();
    }
}
