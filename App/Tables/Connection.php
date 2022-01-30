<?php

namespace App\Tables;

use PDO;

class Connection {

    /**
     * Le nom d'utilisateur sera par défaut à 'root'
     * 
     * @var string
     */
    private static $name = 'root';

    /**
     * Le host par défaut sera  'localhost' 
     * 
     * @var string
     */
    private static $host = 'localhost';
    
    /**
     * Le mot de passe de la base de données par défaut  = '' chaine vide
     * 
     * @var string
     */
    static $pass = '';
    
    /**
     * Le nom de la base de données 
     * 
     * @var string
     */
    private static $dbname = 'morts';

    private static $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS
    ];
    
   /**
    * Connexion à la base de données 

    * @return PDO
    */
    static function getPDO(): PDO
    {
        return new PDO(
            "mysql:host=" . self::$host . ";dbname=" . self::$dbname . "",
            self::$name, self::$pass, self::$options
            
        );
    }
}