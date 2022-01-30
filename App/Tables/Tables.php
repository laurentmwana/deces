<?php

namespace App\Tables;

use PDO;

/**
 * Tables de 
 */
class Tables {

    /**
     * @var PDO
     */
    private $pdo;


    /**
     * Tables Constructor
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}