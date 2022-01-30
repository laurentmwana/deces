<?php

namespace App\Controller;

interface PostInterface {

    /**
     * @param string $name
     * 
     * @return string
     */
    public function get (string $name): string;

    /**
     * @param mixed $key
     * 
     * @return self
     */
    public function echap ($key): self;

    /**
     * @param string $name
     * @param string $value
     * 
     * @return self
     */
    public function set (string $name, string $value): self;

    /**
     * @param array $data
     * @param string $method
     * 
     * @return void
     */
    public static function method ($data = [], $method = 'POST'): void;

    /**
     * @param mixed $keys
     * @param string $trim
     * 
     * @return self
     */
    public function trim ($keys, $trim = "\t\n\r\0\x0B"): self;

    /**
     * @param mixed $key
     * 
     * @return bool
     */
    public function status ($key): bool;

    /**
     * @return bool
     */
    public function emptyData (): bool;


    /**
     * @return void
     */
    public function reset (): void;

}
