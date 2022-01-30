<?php

namespace App\Routes;


class Router {

    private $routes = [];
    private $nameRoutes = [];
    private string $prefix;

    public function addRoutes (string $method, string $path, callable $callback, ?string $nameRoute = null): Route {
        $route = new Route($path, $callback);
        $this->routes[$method][] = $route;
        if ($nameRoute) {
            $this->nameRoutes[$nameRoute] = $route;
        }

        return $route;
    }


    public function get (string $path, callable $callback, ?string $nameRoute = null): self {
        $this->addRoutes("GET", $path, $callback, $nameRoute);
        return $this;
    }

    public function post (string $path, callable $callback, ?string $nameRoute = null): self {
        $this->addRoutes("POST", $path, $callback, $nameRoute);
        return $this;
    }


    /**
     *
     * @param string $url
     * @return void
     */
    public function run (string $url, ?string $prefix = null) {
        $this->prefix = $prefix;
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($url)) {
                return $route->execute();
            }
        }
       throw new RouterException("Fichier introuvable");
    }


  
    public function GenerateUri(string $name = 'home', array $parameters = []): string
    {
        if (!isset($this->nameRoutes[$name])) {
            throw new RouterException("Le nom du route '$name' n'existe pas");
        }

        if (!empty($this->prefix) && !is_null($this->prefix)) {
            return  DIRECTORY_SEPARATOR .  $this->prefix . DIRECTORY_SEPARATOR . $this->nameRoutes[$name]->getParams($parameters);
        } else {
            return  DIRECTORY_SEPARATOR .  $this->nameRoutes[$name]->getParams($parameters);
        }

       
    }






}