<?php

use App\Model\Article;

require_once "src/database.php";
require_once "src/utils.php";
require_once "src/Model/Article.php";

$model = new Article();

render("articles/index", "Accueil", [
    "articles" => $model->findAll()
]);
