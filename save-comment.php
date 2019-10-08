<?php

require_once "src/database.php";
require_once "src/utils.php";

$author = null;
if (!empty($_POST['author'])) {
    $author = $_POST['author'];
}

$content = null;
if (!empty($_POST['content'])) {
    $content = htmlspecialchars($_POST['content']);
}

$article_id = null;
if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
}

if (!$author || !$article_id || !$content) {
    die("Votre formulaire a été mal rempli !");
}

$article = findArticle($article_id);

if (!$article) {
    die("Ho ! L'article $article_id n'existe pas boloss !");
}

createComment($author, $content, $article_id);

redirect("article.php?id=" . $article_id);
