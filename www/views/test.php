<?php

require_once '../controller/productsManager.php';
require_once '../controller/typesManager.php';

$productsManager = new ProductsManager();
$products = $productsManager->getProductsById(37);
$name = "COUVERTINE";
$productsByName = $productsManager->getProductsByName($name);

$typesManager = new TypesManager();
$types = $typesManager->getTypesById(1);
