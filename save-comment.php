<?php

use App\Controller\Comment as Comment;

require_once "src/autoload.php";

$controller = new Comment();
$controller->create();
