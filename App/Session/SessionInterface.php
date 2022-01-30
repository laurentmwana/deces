<?php

namespace App\Session;

interface SessionInterface {

    /**
     * @return Session
     */
    public static function getSession (): Session;

    /**
     * @param mixed $keys
     * 
     * @return array
     */
    public function get ($keys): array;

    /**
     * @param mixed $keys
     * @param mixed $value
     * 
     * @return self
     */
    public function set ($keys, $value): self;

    /**
     * @param mixed $keys
     * 
     * @return bool
     */
    public function has ($keys): bool;

    /**
     * @param mixed $keys
     * 
     * @return self
     */
    public function setKey ($keys): self;

    /**
     * @param mixed $keys
     * 
     * @return string
     */
    public function getKey ($keys): string;

    /**
     * @param mixed $formate
     * 
     * @return array
     */
    public function formate ($formate): array;

}