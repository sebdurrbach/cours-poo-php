<?php

namespace App\Controller;

abstract class Controller
{
    protected function render(string $path, string $pageTitle, array $variables): void
    {
        extract($variables);

        ob_start();
        require('templates/' . $path . '.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');
    }

    protected function redirect(string $url)
    {
        header('Location: ' . $url);
        exit();
    }
}
