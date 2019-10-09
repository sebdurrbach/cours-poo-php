<?php

use App\Controller\Article;

require_once "src/autoload.php";

$controller = new Article();

$controller->index();
