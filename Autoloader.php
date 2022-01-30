<?php


class Autoloader {

    public static function register (): void {
        spl_autoload_register([__CLASS__, "autoload"]);
    }

    public  static function autoload ($class): void {
        
        $class = str_replace(__NAMESPACE__ . "\\", DIRECTORY_SEPARATOR , $class); 
        require $class . ".php";
    }
}
