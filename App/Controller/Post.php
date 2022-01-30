<?php

namespace App\Controller;

class Post implements PostInterface {

    static $data = [];

    /**
     * @param array $data
     * @param string $method
     * 
     * @return void
     */
    public static function method($data = [], $method = 'POST'): void
    {
        if (isset($_SERVER["REQUEST_METHOD"])) {
            if ($_SERVER["REQUEST_METHOD"] === $method) {
                self::$data = $data;
            }
        }
    }

    /**
     * @param string $name
     * 
     * @return string
     */
    public function get(string $name): string 
    {
        if (isset(self::$data[$name])) {
            return htmlentities(self::$data[$name]);
        }

        return "";
    }

    /**
     * @param string $name
     * @param string $value
     * 
     * @return PostInterface
     */
    public function set(string $name, string $value): PostInterface
    {
        self::$data[$name] = $value;
        return $this;
    }

    /**
     * @param mixed $key
     * 
     * @return PostInterface
     */
    public function echap ($key): PostInterface
    {
        self::$data[$key] = htmlentities(self::$data[$key]);
        return $this;
    }

    /**
     * @return void
     */
    public function reset(): void
    {
       $_POST = [];
    }

    /**
     * @param mixed $keys
     * @param string $trim
     * 
     * @return PostInterface
     */
    public function trim($keys, $trim = "\t\n\r\0\x0B"): PostInterface
    {
        self::$data[$keys] = trim(self::$data[$keys], $trim);
        return $this;
    }

    /**
     * @param mixed $key
     * 
     * @return bool
     */
    public function status($key): bool
    {
        return isset(self::$data[$key]);
    }

    /**
     * @return bool
     */
    public function emptyData(): bool
    {
        return  empty(self::$data);
    }
}