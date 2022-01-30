<?php

namespace App\Validator;

class FormateValidator {

    /**
     * @var array
     */
    private $validate;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $keys;

    const MESSAGES = [
        "regex" => "Le champs %s doit contenir que des chiffres",
        "regex-letter" => "Le champs %s doit contenir que des lettres",
        'empty' => "Le champs %s ne doit pas etre vide",
        "isdate" => "Le champs %s n'est pas une date (%s)",
        "minlenght" => "Le champs %s doit contenir au moins %s caratères",
        "maxlenght" => "Le champs %s ne doit doit contenir plus de %s caratères"
    ];

    /**
     * @param mixed $validate
     * @param mixed $keys
     */
    public function __construct($validate, $keys, $attributes = [])
    {
        $this->validate = $validate;
        $this->keys = $keys;
        $this->attributes = $attributes;

        
    }

    public function __toString()
    {
        $parameters = [self::MESSAGES[$this->validate],$this->keys];
        $parameters = array_merge($parameters, $this->attributes);
        return (string)call_user_func_array('sprintf', $parameters);
    }
}