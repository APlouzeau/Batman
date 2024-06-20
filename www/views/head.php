<!DOCTYPE html>
<html lang="fr">

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Titillium+Web:wght@200&family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <script defer src="/node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
    <script defer src="/node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
    <script defer src="/node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>