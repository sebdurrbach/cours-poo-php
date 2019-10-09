<?php

namespace App\Model;

use App\Database;

require_once "src/database.php";

abstract class Model
{

    protected $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }
}
