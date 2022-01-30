<?php

namespace App\Validator;

use App\Controller\Post;
use DateTime;

class Validator {

    /**
     * @var Post
     */
    private $post;

    /**
     * @var array
     */
    private $errors = [];

    public $keys = [];



    /**
     * @param array $data
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @param mixed $regex
     * @param mixed $key
     * 
     * @return self
     */
    public function regex ($regex, $key): self {

        if (!preg_match($regex, $this->getData($key))) {
           $this->addError($key, $this->replace[$key], 'regex');
        }

        return $this;
    }

    /**
     * @param mixed $key
     * 
     * @return self
     */
    public function empty ($key): self {
        if (empty($this->getData($key))) {
            $this->addError($key, $this->replace[$key], 'empty');
        }

        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $max
     * 
     * @return self
     */
    public function lenghtMax ($key, $max): self {
        if ((int)strlen($this->getData($key))  > $max) {
            $this->addError($key, $this->replace[$key],'maxlenght',  [$max]);
        }

        return $this;
    }


    /**
     * @param mixed $key
     * @param mixed $min
     * 
     * @return self
     */
    public function lenghtMin ($key, $min): self {
        if ((int)strlen($this->getData($key))  < $min) {
            $this->addError($key, $this->replace[$key],'minlenght', [$min]);
        }

        return $this;
    }

    /**
     * @param mixed $formate
     * 
     * @return self
     */
    public function isdate ($key, $formate = "d/m/Y"): self {
        $format = null;
        try {
            $date = new DateTime($this->getData($key));
            $format = $date->format($formate);
        } catch (\Exception $th) {
            $errors = ($th->getMessage());
        }
       

        if (is_null($format)) {
            
            $this->addError($key, $this->replace[$key], 'isdate', [$errors]);
        }
        return $this;
    }



    /**
     * @param mixed $key
     * 
     * @return string
     */
    public function getData ($key): ?string {
        if ($this->post->status($key)) {
            $this->keys[$key] = $key;
            return $this->post->get($key);
        }

       throw new ValidatorException("La clé {$key} n'a jamais été définit");
    }

    public function replace (string $key, string $replace): self {

        $this->replace[$key] = $replace;

        return $this;
    }

    /**
     * @param mixed $keys
     * @param mixed $validate
     * @param array $attribute
     * 
     * @return void
     */
    private function addError ($key, $keyReplace, $validate, $attribute = []): void {
        $this->errors[$key] = new FormateValidator($validate, $keyReplace, $attribute);
    }

    /**
     * @return array
     */
    public function getError (): array {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function isValid (): bool {
        return empty($this->errors);
    }
}