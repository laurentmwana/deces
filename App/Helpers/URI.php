<?php

namespace App\Helpers;


class URI {

    /**
     * @param mixed $key
     * @param int $default
     * 
     * @return int
     */
    public static function getInt ($key, $default = 1): int  {

        if(!isset($_GET[$key])){
            return $default;
        }

        else if (!filter_var($_GET[$key] , FILTER_VALIDATE_INT)) {
            Throw new HelpersException ("Paramètre $key n'est pas un entier ");
        }

        else {
            return (int)$_GET[$key];
        }
    }

    /**
     * @param mixed $key
     * @param string $default
     * 
     * @return string
     */
    public function getString ($key , $default = "v"): string {
        if(!isset($_GET[$key])){
            return $default;
        }

        else if (!is_string($_GET[$key])) {
            Throw new HelpersException ("Paramètre $key n'est pas une chaine de caratères ");
        }

        else {
            return (string)$_GET[$key];
        }
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * 
     * @return string
     */
    public static function params ($key, $value): string {
        $data = $_GET;
        // l'efface le paramètre url (qui permet de charger un fichier depuis le routeur)
        unset($data['url']);

        $query = http_build_query(array_merge($data , [$key => $value]));
        return  '?' . $query ;
    }

}