<?php

use App\Model\Article;

require_once "src/autoload.php";

$model = new Article();

render("articles/index", "Accueil", [
    "articles" => $model->findAll()
]);
