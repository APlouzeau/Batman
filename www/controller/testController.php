<?php



class TestController extends PDOServer
{
    public function test()
    {
        $array = [
            'description1', 'tache1',
            'description2', 'tache2',
            'description3', 'tache3',
            'description4', 'tache4',
            'description5', 'tache5',
            'description6', 'tache6'
        ];
        $result = 0;
        $search = 'description';
        foreach ($array as $value) {
            if (substr_count($value, $search) == 1) {
                $result++;
            }
        }
    }
}
