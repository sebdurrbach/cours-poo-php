<?php

namespace App\Controller;

use App\Model\Article as ArticleModel;

class Article
{

    protected $model;

    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    public function index()
    {
        render("articles/index", "Accueil", [
            "articles" => $this->model->findAll()
        ]);
    }

    public function show(int $article_id)
    {
        $article = $this->model->find($article_id);

        $commentModel = new \App\Model\Comment();
        $commentaires = $commentModel->findAll($article_id);

        render("articles/show", $article['title'], compact("article_id", "commentaires", "article"));
    }

    public function delete(int $id)
    {
        $article = $this->model->find($id);

        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        $this->model->delete($id);

        redirect("/");
    }
}
