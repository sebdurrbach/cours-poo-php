<?php

use App\Controller\Comment;

require_once "src/autoload.php";

$controller = new Comment();
$controller->delete();
