<?php

require_once "src/database.php";
require_once "src/utils.php";

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];

$pdo = getPdo();

$article = findArticle($id);

if (!$article) {
    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}

deleteArticle($id);

redirect("index.php");
