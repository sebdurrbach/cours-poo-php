<?php

require_once "src/database.php";
require_once "src/utils.php";

$article_id = null;

if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}

if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}

$article = findArticle($article_id);

if (!$article) throw new Exception("L'article n'existe pas.");

$commentaires = findAllComments($article_id);

render("articles/show", $article['title'], compact("article_id", "commentaires", "article"));
