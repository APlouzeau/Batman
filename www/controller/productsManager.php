<?php

require_once "../models/productsModel.php";
require_once "../models/PDOServer.php";
class ProductsManager extends PDOServer
{

    public function addProducts(Products $product)
    {
        $req = $this->db->prepare("INSERT INTO products (name, type, length, recovery, summary, descriptionProduct, price) VALUE (:name, :type, :length, :recovery, :summary, :descriptionProduct, :price)");
        $req->bindValue(":name", $product->getName(), PDO::PARAM_STR);
        $req->bindValue(":type", $product->getType(), PDO::PARAM_STR);
        $req->bindValue(":length", $product->getLength(), PDO::PARAM_STR);
        $req->bindValue(":recovery", $product->getRecovery(), PDO::PARAM_STR);
        $req->bindValue(":summary", $product->getSummary(), PDO::PARAM_STR);
        $req->bindValue(":description", $product->getDescriptionProduct(), PDO::PARAM_STR);
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
        $req = $this->db->prepare("UPDATE products SET name = :name, type = :type, summary = :summary, descriptionProduct = :descriptionProduct, length = :length, recovery = :recovery, price = :price WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->bindValue(":name", $product->getName(), PDO::PARAM_STR);
        $req->bindValue(":type", $product->getType(), PDO::PARAM_STR);
        $req->bindValue(":length", $product->getLength(), PDO::PARAM_STR);
        $req->bindValue(":recovery", $product->getRecovery(), PDO::PARAM_STR);
        $req->bindValue(":summary", $product->getSummary(), PDO::PARAM_STR);
        $req->bindValue(":description", $product->getDescriptionProduct(), PDO::PARAM_STR);
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
    public function getProductsByName($name)
    {
        $req = $this->db->query("SELECT * FROM products WHERE name = '$name'");
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

    public function getNameProductsByIdTask($idTask)
    {
        $req = $this->db->query("SELECT name FROM products WHERE id = '$idTask'");
        $data = $req->fetch();
        return $data;
    }
}
