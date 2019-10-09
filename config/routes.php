<?php

use App\Controller\Article;
use App\Controller\Comment;
use App\Database;
use App\Model\Article as ArticleModel;
use App\Model\Comment as CommentModel;

return [
    '/' => function () {
        $controller = new Article(new ArticleModel(new Database), new CommentModel(new Database));
        $controller->index();
    },
    '/article/{id}/delete' => function (array $params) {
        $controller = new Article(new ArticleModel(new Database), new CommentModel(new Database));
        $controller->delete($params['id']);
    },
    '/article/{id}/comment' => function (array $params) {
        $controller = new Comment(new CommentModel(new Database), new ArticleModel(new Database));
        $controller->create();
    },
    '/article/{id}' => function (array $params) {
        $controller = new Article(new ArticleModel(new Database), new CommentModel(new Database));
        $controller->show((int) $params['id']);
    },
    '/comment/{id}/delete' => function (array $params) {
        $controller = new Comment(new CommentModel(new Database), new ArticleModel(new Database));
        $controller->delete($params['id']);
    }
];
