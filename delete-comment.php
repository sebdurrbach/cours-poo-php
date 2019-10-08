<?php

use App\Model\Comment;

require_once "src/autoload.php";

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];

$pdo = getPdo();

$model = new Comment();
$commentaire = $model->find($id);
if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

$article_id = $commentaire['article_id'];

$model->delete($id);

redirect("article.php?id=" . $article_id);
