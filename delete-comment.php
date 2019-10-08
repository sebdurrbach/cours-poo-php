<?php

use App\Model\Comment;

require_once "src/database.php";
require_once "src/utils.php";
require_once "src/Model/Comment.php";

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];

$pdo = getPdo();

$model = new Comment();
$commentaire = find($id);
if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

$article_id = $commentaire['article_id'];

deleteComment($id);

redirect("article.php?id=" . $article_id);
