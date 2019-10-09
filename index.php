<?php

use App\Controller\Article;
use App\Controller\Comment;

require_once "src/autoload.php";

$path = "/";

if (array_key_exists('PATH_INFO', $_SERVER)) {
    $path = $_SERVER['PATH_INFO'];
}

$segments = explode("/", $path);

if ($path === "/") { // accueil
    $controller = new Article;
    $controller->index();
} elseif ( // article/id
    count($segments) === 3 &&
    $segments[1] === "article" &&
    ctype_digit($segments[2])
) {
    $controller = new Article;
    $controller->show($segments[2]);
} elseif ( // comment/id/delete
    count($segments) === 4 &&
    $segments[1] === "comment" &&
    ctype_digit($segments[2]) &&
    $segments[3] === "delete"
) {
    $controller = new Comment;
    $controller->delete($segments[2]);
} elseif ( // article/id/comment
    count($segments) === 4 &&
    $segments[1] === "article" &&
    ctype_digit($segments[2]) &&
    $segments[3] === "comment"
) {
    $controller = new Comment;
    $controller->create();
} elseif ( //article/id/delete
    count($segments) === 4 &&
    $segments[1] === "article" &&
    ctype_digit($segments[2]) &&
    $segments[3] === "delete"
) {
    $controller = new Article;
    $controller->delete($segments[2]);
}
