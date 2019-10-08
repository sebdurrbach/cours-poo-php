<?php

use App\Model\Article;

require_once "src/database.php";
require_once "src/utils.php";
require_once "src/Model/Article.php";

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];

$pdo = getPdo();

$articleModel = new Article();
$article = $articleModel->find($id);

if (!$article) {
    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}

$model->delete($id);

redirect("index.php");
