<?php

use App\Controller\Article;
use App\Controller\Comment;
use App\Database;
use App\Model\Article as ArticleModel;
use App\Model\Comment as CommentModel;

class ServicesManager
{
    protected $services = [];

    public function register(string $name, callable $fn)
    {
        $this->services[$name] = $fn;
    }

    public function get(string $name)
    {
        $constructor = $this->services[$name];
        return $constructor($this);
    }
}

$manager = new ServicesManager();

$manager->register('controller.article', function (ServicesManager $manager) {
    $articleModel = $manager->get('model.article');
    $commentModel = $manager->get('model.comment');

    return new Article($articleModel, $commentModel);
});

$manager->register('controller.comment', function (ServicesManager $manager) {
    $articleModel = $manager->get('model.article');
    $commentModel = $manager->get('model.comment');

    return new Comment($commentModel, $articleModel);
});

$manager->register('model.article', function (ServicesManager $manager) {
    $database = $manager->get('database');
    return new ArticleModel($database);
});

$manager->register('model.comment', function (ServicesManager $manager) {
    $database = $manager->get('database');
    return new CommentModel($database);
});

$manager->register('database', function () {
    return new Database();
});


return [
    '/' => function () use ($manager) {
        $controller = $manager->get('controller.article');
        $controller->index();
    },
    '/article/{id}/delete' => function (array $params) use ($manager) {
        $controller = $manager->get('controller.article');
        $controller->delete($params['id']);
    },
    '/article/{id}/comment' => function (array $params) use ($manager) {
        $controller = $manager->get('controller.comment');
        $controller->create();
    },
    '/article/{id}' => function (array $params) use ($manager) {
        $controller = $manager->get('controller.article');
        $controller->show((int) $params['id']);
    },
    '/comment/{id}/delete' => function (array $params) use ($manager) {
        $controller = $manager->get('controller.comment');
        $controller->delete($params['id']);
    }
];
