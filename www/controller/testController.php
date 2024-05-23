<?php



class TestController extends PDOServer
{
    public function test()
    {
        $prefix = date("ym");
        $req = $this->db->prepare("SELECT * FROM estimate WHERE imput LIKE :prefix");
        $req->bindValue(":prefix", $prefix . '%', PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetchAll();
        $imput = sprintf(strval($prefix) . "%'.03d\n", strval(count($data)) + 1);
        $req = $this->db->prepare("UPDATE estimate SET driver = $driver, imput = :imput WHERE id = $idEstimate");
        $req->bindValue(":imput", $imput, PDO::PARAM_STR);
    }
}
