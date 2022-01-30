<?php

namespace App\Session;


class Session implements SessionInterface {

    private $key = "flash";

    /**
     * @var string
     */
    private static $session;

    /**
     * @return Session
     */
    public static function getSession(): Session
    {
        if (is_null((self::$session))) {
            self::$session = new Session();
        }

        return self::$session;
    }

    /**
     * Session Constructor 
     */
    public function __construct()
    {
        if (session_status() ===  PHP_SESSION_NONE) {
           session_start();
        }
    }

    /**
     * @param mixed $formate
     * 
     * @return array
     */
    public function formate($formate): array
    {
        $formate = [];
        $formate[$formate] = $this->get($this->key);
        return $formate;
    }


    /**
     * @param mixed $keys
     * @param mixed $value
     * 
     * @return SessionInterface
     */
    public function set($keys, $value): SessionInterface
    {
        $_SESSION[$this->key][$keys] = $value;
        return $this;
    }

    /**
     * @param mixed $keys
     * 
     * @return array
     */
    public function get($keys): array
    {
        if ($this->has($keys)) {
            $message = $_SESSION[$this->key];
            unset($_SESSION[$this->key]);
            return  $message;
        } 
        
        
        return [];
       
    }

    /**
     * @param mixed $keys
     * 
     * @return bool
     */
    public function has($keys): bool
    {
        if (isset($_SESSION[$keys])) {
            return true;
        }

        return false;
    }

    /**
     * @param mixed $keys
     * 
     * @return SessionInterface
     */
    public function setKey($keys): SessionInterface
    {
        $this->key = $keys;
        return $this;
    }

    /**
     * @param mixed $keys
     * 
     * @return string
     */
    public function getKey($keys): string
    {
        return $this->key;
    }
}