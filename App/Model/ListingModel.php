<?php

namespace App\Model;

use App\Framework\Tables\Builder\QueryBuilder;
use App\Framework\Tables\Connection;
use PDO;

class ListingModel extends Model{


    /**
     * @param mixed $table
     * 
     * @return array
     */
    public function selected ($table, $class): array {
        return $this->query() 
        ->select('*')
        ->setClass($class)
        ->from($table)
        ->execute();
    }

    /**
     * @return QueryBuilder
     */
    protected function getBuilder (): QueryBuilder {
        return new QueryBuilder(Connection::getPDO());
    }

    public function countParameter ($table, $class, $value, $where): array {
        return ($this->query() 
        ->select("*")
        ->setClass($class)
        ->where($where)
        ->from($table)
        ->values($value)
        ->execute());
    }

    /**
     * @param mixed $table
     * @param mixed $class
     * @param string $id
     * 
     * @return int
     */
    public function count ($table, $class, $id = "id"): int {
        return count($this->query() 
        ->select($id)
        ->setClass($class)
        ->from($table)
        ->execute());
    }
}