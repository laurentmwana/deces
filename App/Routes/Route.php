<?php


namespace App\Routes;

class Route {

    /**
     *
     * @var string
     */
    private string $path;
    
    /**
     *
     * @var callable
     */
    private $callback;

    /**
     * tableau de matches qui ont des paramètre
     *
     * @var array
     */
    private $matches = [];

    /**
     * Route constructor 
     *
     * @param string $path
     * @param callable $callback
     */
    public function __construct(string $path, callable $callback)
    {
        $this->path = trim($path, DIRECTORY_SEPARATOR);
        $this->callback = $callback;
    }

    /**
     * route match
     *
     * @param string $url
     * @return boolean
     */
    public function match (string $url): bool {
        $path = preg_replace("#:([\w]+)#", "([^/]+)", $this->path);
        $regex = "#^{$path}$#";

        if (preg_match($regex, $url, $matches)) {
            array_shift($matches);
            $this->matches = $matches;
            return true;
        }

        return false;
    }

    /**
     * Remplcaer le matches à la valeur corrspondente
     *
     * @param array $params
     * @return string
     */
    public function getParams (array $params = []): string {
        $path = $this->path;
        foreach ($params as $key => $value) {
            $path = str_replace(":$key", $value, $path);
        }

        return $path;
    }

    /**
     * l'execution du routeur
     *
     * @return void
     */
    public function execute () {
        return call_user_func_array($this->callback, $this->matches);
    }
}