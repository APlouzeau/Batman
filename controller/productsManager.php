<?php

require_once "../models/productsModel.php";

class ProductsManager
{
    private $db;

    public function __construct()
    {
        $dbName = "sopeyo";
        $port = "3306";
        $userName = "root";
        try {
            $this->db = new PDO("mysql:host=localhost; dbname=$dbName; port=$port", $userName, "");
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "La connexion à la base de donnée a échouée.";
        }
    }

    public function addProducts(Products $product)
    {
        $req = $this->db->prepare("INSERT INTO products (name, length, recovery, summary, description, price) VALUE (:name, :length, :recovery, :summary, :description, :price)");
        $req->bindValue(":name", $product->getName(), PDO::PARAM_STR);
        $req->bindValue(":length", $product->getLength(), PDO::PARAM_STR);
        $req->bindValue(":recovery", $product->getRecovery(), PDO::PARAM_STR);
        $req->bindValue(":summary", $product->getSummary(), PDO::PARAM_STR);
        $req->bindValue(":description", $product->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":price", $product->getPrice(), PDO::PARAM_STR);
        $req->execute();
    }

    public function showProducts()
    {
        $products = [];
        $req = $this->db->query("SELECT * FROM products ORDER BY name");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $product = new Products($data);
            $products[] = $product;
        }
        return $products;
    }

    public function updateProducts(Products $product, $id)
    {
        $req = $this->db->prepare("UPDATE products SET name = :name, summary = :summary, description = :description, length = :length, recovery = :recovery, price = :price WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->bindValue(":name", $product->getName(), PDO::PARAM_STR);
        $req->bindValue(":length", $product->getLength(), PDO::PARAM_STR);
        $req->bindValue(":recovery", $product->getRecovery(), PDO::PARAM_STR);
        $req->bindValue(":summary", $product->getSummary(), PDO::PARAM_STR);
        $req->bindValue(":description", $product->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":price", $product->getPrice(), PDO::PARAM_STR);
        $req->execute();
    }

    public function getProductsById(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $product = new Products($data);
        return $product;
    }

    public function deleteProducts(int $id)
    {
        $req = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }

    /* public function getPriceProductSelected()
    {
        $req = $this->db->prepare("SELECT price FROM product WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    } */
}
