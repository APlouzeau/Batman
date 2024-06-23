<?php

require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/typesManager.php";
require_once APP_PATH . "/models/productsManager.php";

class ProductController
{

    public function createProduct()
    {
        if (
            $_POST &&
            $_SESSION['role'] != 'Assistant' &&
            $_SESSION['role'] != 'Comptable' &&
            $_POST['csrf_token'] == $_SESSION['csrf_token']
        ) {
            $inputNames = [
                'name',
                'type',
                'length',
                'recovery',
                'summary',
                'descriptionProduct',
                'price',
                'unit'
            ];
            $xss = xss($inputNames);
            if (gettype($xss) == 'array') {
                try {
                    $newProduct = new Products($xss);
                    $productsManager = new ProductsManager();
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
        $rollList = $productsManager->showProductsCatalog();
        $typesManager = new TypesManager();
        $typesList = $typesManager->showTypes();
        $titlePage = 'Produits';
        require_once APP_PATH . '/views/products.php';
    }
    public function details()
    {
        $productsManager = new ProductsManager();
        $roll = $productsManager->getProductsById($_GET["id"]);
        $titlePage = $roll->getName();
        require_once APP_PATH . '/views/detailsProducts.php';
    }

    public function modifyProductPage()
    {
        if ($_GET && $_SESSION['role'] == 'Administrateur' && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            $productsManager = new ProductsManager();
            $product = $productsManager->getProductsById($_GET["id"]);
            $typesManager = new TypesManager();
            $typesList = $typesManager->showTypes();
            $titlePage = $product->getName();
            require_once APP_PATH . '/views/modifyProducts.php';
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function modifyProduct()
    {
        if ($_POST && $_SESSION['role'] == 'Administrateur' && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
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
        if ($_GET && $_SESSION['role'] == 'Administrateur'  && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
            $productsManager = new ProductsManager();
            $productsManager->deleteProducts($_GET["id"]);
            $this->products();
        } else {
            echo "Vous n'avez pas les droits pour acceder à cette page.";
        }
    }

    public function verifyName()
    {
        $name = $_POST['name'];
        if (is_null($name)) {
            return json_encode('Nom obligatoire');
        }
        try {
            $productsManager = new ProductsManager();
            $result = $productsManager->verifyNameManager($name);
            echo (is_array($result) && sizeof($result) >= 1 && $result[0] !== false) ? json_encode(false) : json_encode(true);
        } catch (Exception $e) {
            return json_encode('Le produit existe déjà');
        }
    }
}
