<?php

namespace App;

class Header  {

    /**
     * @param string $header
     * @param int $code
     * 
     * @return void
     */
    public static function redirect (string $header, int $code = 301): void
    {
        header("location: {$header}", true, $code);
        exit();
    }
}