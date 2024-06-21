<?php

function xss(array $inputNames)
{
    $xss = [];
    $count = 0;
    foreach ($inputNames as $name) {
        $xss[$name] = htmlspecialchars($_POST[$name], ENT_NOQUOTES);
        if ($xss[$name] == $_POST[$name]) {
            $count++;
            if ($count == count($inputNames)) {
                return $xss;
            }
        } else {
            echo 'Caractère non-autorisée dans le champ ' . $name . '<br>';
        }
    }
}

function xssConnect(array $inputNames)
{
    $xss = [];
    $count = 0;
    foreach ($inputNames as $name) {
        $xss[$name] = htmlspecialchars($_POST[$name]);
        if ($xss[$name] == $_POST[$name]) {
            $count++;
            if ($count == count($inputNames)) {
                return $xss;
            }
        }
    }
}
