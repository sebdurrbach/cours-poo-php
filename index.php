<?php

require_once "src/database.php";
require_once "src/utils.php";

render("articles/index", "Accueil", [
    "articles" => findAllArticles()
]);
