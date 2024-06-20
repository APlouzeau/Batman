<?php

class CommonFunctions
{
    public function xss(array $inputNames)
    {
        $xss = [];
        $count = 0;
        foreach ($inputNames as $name) {
            $xss[$name] = htmlspecialchars($_POST[$name], ENT_NOQUOTES);
            if ($xss[$name] == $_POST[$name]) {
                $count++;
                if ($count == count($inputNames)) {
                    var_dump($xss);
                    return $xss;
                }
            } else {
                echo 'Caractère non-autorisée dans le champ ' . $name . '<br>';
            }
        }
    }
}
