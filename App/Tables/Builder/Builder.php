<?php

namespace App\Tables\Builder;

use PDO;

class Builder {
    
    /**
     * @var PDO
     */
    protected PDO $pdo;
    
    private $nameTable;

    /**
     * Construtor Builder
     * 
     * @param PDO $pdo
     * @param string $nameTable
     */
    public function __construct(PDO $pdo) 
    {
        $this->pdo = $pdo;
        
    }
}