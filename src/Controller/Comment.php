<?php

namespace App\Controller;

use App\Model\Comment as CommentModel;

class Comment
{
    protected $model;

    public function __construct()
    {
        $this->model = new CommentModel;
    }

    public function delete()
    {
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }

        $id = $_GET['id'];

        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        $article_id = $commentaire['article_id'];

        $this->model->delete($id);

        redirect("article.php?id=" . $article_id);
    }

    public function create()
    {
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

        $articleModel = new \App\Model\Article();
        $article = $articleModel->find($article_id);

        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        $this->model->create($author, $content, $article_id);

        redirect("article.php?id=" . $article_id);
    }
}
