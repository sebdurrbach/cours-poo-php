<?php

namespace App\Model;

require_once "src/database.php";

abstract class Model
{

    protected $db;

    public function __construct()
    {
        $this->db = getPdo();
    }
}
