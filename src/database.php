<?php

namespace App;

use PDO;

class Database
{
    /**
     * Crée une connexion PDO
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}
