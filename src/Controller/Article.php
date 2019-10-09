<?php

namespace App\Controller;

use App\Model\Article as ArticleModel;
use App\Model\Comment as CommentModel;

class Article extends Controller
{

    protected $model;
    protected $commentModel;

    public function __construct(ArticleModel $model, CommentModel $commentModel)
    {
        $this->model = $model;
        $this->commentModel = $commentModel;
    }

    /**
     * Page d'accueil
     *
     * @return void
     */
    public function index()
    {
        $this->render("articles/index", "Accueil", [
            "articles" => $this->model->findAll()
        ]);
    }

    /**
     * Page d'article avec ID
     *
     * @param integer $article_id
     * @return void
     */
    public function show(int $article_id)
    {
        $article = $this->model->find($article_id);

        $commentaires = $this->commentModel->findAll($article_id);

        $this->render("articles/show", $article['title'], compact("article_id", "commentaires", "article"));
    }

    /**
     * Suppression d'article avec ID
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $article = $this->model->find($id);

        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        $this->model->delete($id);

        $this->redirect("/");
    }
}
