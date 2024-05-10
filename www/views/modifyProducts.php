<?php
define("BASE_URL", "/EYOSOP");
require_once "./head.php";
?>

<title>Modifier rouleau</title>

<?php
require_once "./header.php";
require_once "../controller/productsManager.php";
require_once "../controller/typesManager.php";


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
    $description = $_POST["description"];
    $price = $_POST["price"];
    try {
        $updateProduct = new Products([
            "id" => $id,
            "name" => $name,
            "type" => $type,
            "length" => $length,
            "recovery" => $recovery,
            "summary" => $summary,
            "description" => $description,
            "price" => $price,
        ]);
        $productsManager->updateProducts($updateProduct, $id);
        header("Location:products.php");
        echo "La modification a réussi.";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}


?>

<form method="post" class="container">
    <label class="form-label" for="name">Nom / Ref</label>
    <input type="name" name="name" id="name" class="form-control" min=1 max=255 value="<?= $product->getName() ?>">
    <label class="form-label" for="type">Type</label>
    <select class="form-select" type="type" name="type" id="type" aria-label="Default select example">
        <?php foreach ($typesList as $type) { ?>
            <option class="" value="<?= $type->getID() ?>"><?= $type->getName() ?></option>
        <?php
        }
        ?>
        <label class="form-label" for="length">Longueur</label>
        <input type="number" name="length" id="length" class="form-control" placeholder="Longueur du rouleau en m" value="<?= $product->getLength() ?>">
        <label class="form-label" for="recovery">Recouvrement</label>
        <input type="number" name="recovery" id="recovery" class="form-control" placeholder="Le recouvrement longitudinal en mm" value="<?= $product->getRecovery() ?>"></input>
        <label class="form-label" for="summary">Résumé</label>
        <input type="text" name="summary" id="summary" class="form-control" placeholder="Résumé succint concernant le rouleau" value="<?= $product->getSummary() ?>"></input>
        <label class="form-label" for="description">Description</label>
        <input type="text" name="description" id="description" class="form-control" placeholder="Description/destination du rouleau" value="<?= $product->getDescription() ?>"></input>
        <label class="form-label" for="price">Prix</label>
        <input type="text" name="price" id="price" class="form-control" placeholder="Prix au m²" value="<?= $product->getPrice() ?>"></input>
        <input type="submit" value="Modifier" class="btn btn-success mt-3">
</form>

<?php
require_once "../views/footer.php";
