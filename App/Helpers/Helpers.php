<?php

namespace App\Helpers;


class Helpers {


    /**
     * @param string $value
     * @param string $formate
     * 
     * @return string
     */
    public static function formate (string $value, string $formate = "@"): string {
        return $formate . $value;
    }
}