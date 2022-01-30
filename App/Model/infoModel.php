<?php

namespace App\Model;

class infoModel extends Model {

    /**
     * @var array
     */
    private $keys = [];

    /**
     * @param array $keys
     */
    public function __construct(array $keys = [])
    {
        $this->keys = $keys;
    }

    /**
     * @param mixed $table
     * @param mixed $class
     * 
     * @return array|false
     */
    public function selectInfoDeces($table, $class) {
        $data =  $this->query()->select("*")
        ->from($table)
        ->where("id = :id")
        ->where("name = :name")
        ->where("firtsname = :firtsname")
        ->where("lastname = :lastname")
        
        ->setClass($class)
        ->values([
            ":name" => $this->keys['name'],
            ":firtsname" => $this->keys['firtsname'],
            ":lastname" => $this->keys['lastname'],
            ":id" => $this->keys['id']
        ])->execute();

        
        if (!empty($data)) {
            return $data;
        }

        return false;
    }


    /**
     * @param mixed $table
     * @param mixed $class
     * 
     * @return [type]
     */
    public function selectInfoCauses($table, $class) {
        $data =  $this->query()->select("*")
        ->from($table)
        ->where("id = :id")
        ->where("cause = :cause")
        ->where("reference = :reference")
        
        ->setClass($class)
        ->values([
            ":cause" => $this->keys['cause'],
            ":id" => $this->keys['id'],
            ":reference" => $this->keys['reference']
        ])->execute();

        
        if (!empty($data)) {
            return $data;
        }

        return false;
    }

}