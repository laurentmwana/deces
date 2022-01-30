<?php


namespace App\Tables\Builder;

use PDO;

interface QueryBuilderInterface {

 
    /**
     * @param mixed ...$fields
     * 
     * @return self
     */
    public function select (...$fields): self;


    /**
     * @param string $table
     * @param string|null $alias
     * 
     * @return self
     */
    public function from (string $table, ?string $alias = null): self;

    /**
     * @param ...$rule
     * 
     * @return self
     */
    public function where (...$rule): self;

    /**
     * @param mixed ...$rule
     * 
     * @return self
     */
    public function orderBy (...$rule): self;

    /**
     * @param int $nombre
     * 
     * @return self
     */
    public function limit (int $nombre): self;


    /**
     * @param mixed $value
     * 
     * @return self
     */
    public function offsets ($value): self;


    /**
     * @param string $identified
     * 
     * @return self
     */
    public function delete (string $identified): self;

    /**
     * @param mixed ...$colums
     * 
     * @return self
     */
    public function update (...$colums): self;

    /**
     * 
     * @return self
     */
    public function insert (): self;

    /**
     * @param mixed ...$fields
     * 
     * @return self
     */
    public function set (...$fields): self;


    /**
     * 
     * @return array|false|PDOStatement
     */
    public function execute ();

    /**
     * @param mixed $class
     * 
     * @return [type]
     */
    public function setClass ($class): self;

    /**
     * @param array $values
     * 
     * @return self
     */
    public function values (array $values): self;

    /**
     * @param mixed $keys
     * @param string $formate
     * 
     * @return self
     */
    public function datetime ($keys, $formate = 'now'): self;

    
    /**
     * @param mixed $on
     * @param mixed $keys
     * 
     * @return self
     */
    public function on ($on, $keys): self;

   
    /**
     * @param mixed $join
     * @param mixed $keys
     * 
     * @return self
     */
    public function join ($join, $keys): self;

    /**
     * @param string $start
     * @param string $end
     * @param string $center
     * 
     * @return self
     */
    public function like (string $start = "%", string $end = "%", string $center): self;

}