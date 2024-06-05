<?php

class PDOServer
{
    public PDO $db;

    public function __construct()
    {
        $dbName = "batman";
        $port = "3306";
        $userName = "batman";
        try {
            $this->db = new PDO("mysql:host=localhost; dbname=$dbName; port=$port", $userName, "cPifHwUe[cQF!Ffp");
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "La connexion à la base de donnée a échouée.";
        }
    }
}
