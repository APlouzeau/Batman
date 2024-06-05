<?php


class ProjectsManager extends PDOServer
{
    public function projectRegisteredList()
    {
        $req = $this->db->prepare('SELECT nameEstimate, id FROM estimate WHERE imput IS NOT NULL');
        $req->execute();
        $datas = $req->fetchAll();
        $projects = [];
        foreach ($datas as $data) {
            $projects[] = $data;
        }
        var_dump($projects);
        return $projects;
    }

    public function saveSituation(ProductByTask $productByTask)
    {
        $req = $this->db->prepare('UPDATE productbytask SET situation = :situation WHERE idTask = :idTask AND row = :row');
        $req->bindValue(':situation', $productByTask->getSituation(), PDO::PARAM_INT);
        $req->bindValue(':idTask', $productByTask->getIdTask(), PDO::PARAM_INT);
        $req->bindValue(':row', $productByTask->getRow(), PDO::PARAM_INT);
        $req->execute();
    }
}
