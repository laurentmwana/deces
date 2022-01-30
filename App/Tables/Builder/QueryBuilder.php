<?php

namespace App\Tables\Builder;

use PDO;

/**
 * 
 */
class QueryBuilder extends Builder implements QueryBuilderInterface {

    /**
     * Enregistrer le querybuilder (requete select dans un tableau)
     * 
     * @var array
     */
    private $select;

    private $datetime = [];

    /**
     * @var array
     */
    private $from = [];

    /**
     * @var array
     */
    private $where = [];

    /**
     * @var int
     */
    private $limit;

    /**
     * @var array
     */
    private $orderBy = [];

    /**
     * @var array
     */
    private $by = [];

    
    /**
     * @var array
     */
    private $insert = [];

    /**
     * @var array
     */
    private $update = [];


    /**
     * @var array
     */
    private $delete = [];

    /**
     * @var arry
     */
    private $set = [];

    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $values = [];

    /**
     * @var string
     */
    private $classe;

    private $offsets;

    /**
     * @var array
     */
    private  $join = [];

    /**
     * @var array
     */
    private $on = [];

    private $like;


    /**
     * @param string $champs
     * @param string|null $alias
     * 
     * @return QueryBuilderInterface
     */
    public function select(...$fields): QueryBuilderInterface
    {
        $this->select = $fields;
        return $this;
    }

    /**
     * @param string $table
     * @param string|null $alias
     * 
     * @return QueryBuilderInterface
     */
    public function  from(string $table, ?string $alias = null): QueryBuilderInterface
    {
        $this->from = $table;
        return $this;
    }

    public function setClass($class): QueryBuilderInterface
    {
        $this->classe = $class;
        return $this;
    }

    /**
     * @param mixed $keys
     * @param string $formate
     * 
     * @return QueryBuilderInterface
     */
    public function datetime($keys, $formate = 'now'): QueryBuilderInterface
    {
        $this->datetime[$keys] = $formate;
        return $this;
    }

    /**
     * @param ...$where
     * 
     * @return QueryBuilderInterface
     */
    public function where(...$where): QueryBuilderInterface
    {
        $this->where = array_merge($this->where, $where);
        return $this;
    }

    /**
     * @param int $nombre
     * 
     * @return QueryBuilderInterface
     */
    public function limit(int $nombre): QueryBuilderInterface
    {
        $this->limit = $nombre;
        return $this;
    }

    /**
     * @param mixed $value
     * 
     * @return QueryBuilderInterface
     */
    public function offsets($value): QueryBuilderInterface
    {
        $this->offsets = $value;
        return $this;
    }


    /**
     * @param mixed ...$rule
     * 
     * @return QueryBuilderInterface
     */
    public function orderBy(...$rule): QueryBuilderInterface
    {
        $this->orderBy = array_merge($this->orderBy, $rule);
        return $this;
    }

    
    /**
     * @param mixed ...$colums
     * 
     * @return QueryBuilderInterface
     */
    public function update(...$colums): QueryBuilderInterface
    {
        $this->update = array_merge($this->update, $colums);
        return $this;
    }

    /**
     * @param string $identified
     * 
     * @return QueryBuilderInterface
     */
    public function delete(string $identified): QueryBuilderInterface
    {
        $this->delete = $identified;
        return $this;
    }


    /**
     * 
     * @return QueryBuilderInterface
     */
    public function insert(): QueryBuilderInterface
    {
        $this->insert = "true";
        return $this;
    }

    /**
     * @return QueryBuilderInterface
     */
    public function desc(): QueryBuilderInterface
    {
        $this->desc = "DESC";
        return $this;
    }

    /**
     * @param mixed ...$fields
     * 
     * @return QueryBuilderInterface
     */
    public function set(...$fields): QueryBuilderInterface
    {
        $this->set = array_merge($this->set,$fields);
        return $this;
    }

    /**
     * @param  $mode
     * 
     * @return array|false|PDOStatement
     */
    public function execute()
    {
        
        $statements = $this->__toString();
        if (empty($this->where) && !empty($this->select)) {
            return $this->pdo->query($statements)->fetchAll(PDO::FETCH_CLASS, $this->classe);
        } elseif (!empty($this->where) && !empty($this->select)) {
            $data = $this->pdo->prepare($statements);
            $data->execute($this->values);
            return $data->fetchAll(PDO::FETCH_CLASS, $this->classe);
        } else {
          
            return $this->pdo->prepare($statements)->execute($this->values);
        }
    }

    /**
     * @param string $start
     * @param string $end
     * @param string $center
     * 
     * @return QueryBuilderInterface
     */
    public function like(string $start = "%", string $end = "%", string $center): QueryBuilderInterface
    {
        $this->like = $start . $center . $end;
        return $this;
    }

    /**
     * @param array $values
     * 
     * @return QueryBuilderInterface
     */
    public function values(array $values): QueryBuilderInterface
    {
        $this->values = $values;
        return $this;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        $parts = [];


        if (!is_null($this->select) && !empty($this->select)) {
            $parts[] = 'SELECT';
            $parts[] = implode(',', $this->select);
            $parts[] = $this->getFrom($this->from);

            if (!empty($this->join) && !empty($this->on)) {
                foreach ($this->join as $key => $value) {
                    $parts[] = $value . " " . " ON " . $this->on[$key]; 
                }
            }

            if (!empty($this->where)) {
                $parts[] = $this->getWhere($this->where);
                if (!empty($this->like)) {
                    
                }
            }

                
            if (!empty($this->orderBy)) {
                $parts[] = "ORDER BY";
                $parts[] = implode(",", $this->orderBy);
            }

            if (!is_null($this->limit)) {
                $parts[] = "LIMIT ";
                $parts[] = $this->limit;
            }

            if (!is_null($this->offsets)) {
                $parts[] = "OFFSET";
                $parts[] = $this->offsets;
            }
        }

        if (!empty($this->update)) {
            $parts = [];
            $parts[] = 'UPDATE';
            $parts[] = $this->getFrom($this->from);
            $parts[] = 'SET';
            if (!empty($this->set)) {
               $parts[] = $this->getSet($this->set);
            }
           
            if (!empty($this->datetime)) {
                $parts[] = ', ';
                $parts[] = $this->getdatetitme($this->datetime);
            }
            $parts[] = $this->getWhere($this->where);
        }

        if (!empty($this->delete)) {
            $parts = [];
            $parts[] = 'DELETE';
            $parts[] = $this->getFrom($this->from);
            $parts[] = $this->getWhere($this->where);
        }

        if (!empty($this->insert)) {
            $parts = [];
            $parts[] = 'INSERT INTO ';
            $parts[] = $this->from;
            $parts[] = 'SET ';
            if (!empty($this->set)) {
               $parts[] = $this->getSet($this->set);
            }

            if (!empty($this->datetime)) {
                $parts[] = ', ';
                $parts[] = $this->getdatetitme($this->datetime);
            }

        }

        
        return implode(' ', $parts);
    }

    
    /**
     * @param mixed $on
     * @param mixed $keys
     * 
     * @return QueryBuilderInterface
     */
    public function on($on, $keys): QueryBuilderInterface
    {
        $this->on[$keys] = $on;
        return $this;
    }

    /**
     * @param mixed $join
     * @param mixed $keys
     * 
     * @return QueryBuilderInterface
     */
    public function join($join, $keys): QueryBuilderInterface
    {
        $this->join[$keys] = $join;
        return $this;
    }

    /**
     * @param mixed $datetime
     * 
     * @return string
     */
    private function getdatetitme ($datetime): string {
        $date = [];
        foreach ($datetime as $key => $value) {
            $date[] = " $key = $value ";
        }

        return implode(",", $date);
    }

    /**
     * Ajouter From + le nom de la table 
     * 
     * @param mixed $from
     * 
     * @return string
     */
    private function getFrom ($from): string {

        if (is_null($this->update) || empty($this->update)) {
            $parts[] = "FROM";
         
        }
       
        $parts[] = $from;

        return implode(' ', $parts);
    }

    /**
     * Paramètre where 
     * 
     * @return string
     */
    private function getWhere ($where): string {
        
        $parts[] = "WHERE";

        $parts[] = "(" . implode(") AND (", $where) . ")";
        return implode(' ', $parts);
    }

    /**
     * @param mixed $set
     * 
     * @return string
     */
    private function getSet ($set): string {
        $sets = [];
        foreach ($set as $value) {
            $sets[] = " $value = :$value ";
        }
        $sets = implode(',', $sets);
        return $sets;
    }
    
}