<?php

use App\Controller\Article;
use App\Controller\Comment;

return [
    '/' => function () {
        $controller = new Article;
        $controller->index();
    },
    '/article/{id}/delete' => function (array $params) {
        $controller = new Article;
        $controller->delete($params['id']);
    },
    '/article/{id}/comment' => function (array $params) {
        $controller = new Comment;
        $controller->create();
    },
    '/article/{id}' => function (array $params) {
        $controller = new Article;
        $controller->show((int) $params['id']);
    },
    '/comment/{id}/delete' => function (array $params) {
        $controller = new Comment;
        $controller->delete($params['id']);
    }
];
