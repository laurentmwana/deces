<?php


namespace App;

use App\Routes\Router;

class App {

    /**
     * @var Router
     */
    private  Router $route;

    /**
     * @var Renderer
     */
    private Renderer $render;

    /**
     * @var array
     */
    private $module = [];
    
    /**
     * App constructor
     *
     * @param array $modules
     * @param array $dependecies
     */
    public function __construct(array $modules, array $dependecies = []) {
        $this->route = new Router();
        if (array_key_exists('renderer', $dependecies)) {
            $dependecies['renderer']->addGlobals('route', $this->route);
            $this->render = $dependecies['renderer'];
        }
        foreach ($modules as $module) {
            $this->module = new $module($this->route, $this->render);
        }
    }

    /**
     * execution de l'application (demarrage)
     *
     * @return mixed
     */
    public function run () {
        list($url, $prefix) = $this->uri();
        return $this->route->run($url, $prefix);
    }
    
    /**
     * Formate l'url
     *
     * @return array
     */
    private function uri (): array {
        $uri = $_SERVER["REQUEST_URI"];
        $prefix = "";
        $url = "";

        if (isset($_GET['url']) && ($_GET['url'] === $uri)) {
            $url = $_GET["url"];
        } elseif (isset($_GET['url']) && ($_GET['url'] !== $uri)) {
            $remove = explode("/", trim($uri, "/"));
            $prefix = $remove[0];
            array_shift($remove);
            $url = implode("/", $remove);

        } else {
            $url = trim($uri, "/");
        }
        
        $url = explode("?", $url)[0];

        return  [$url, $prefix];
    }
}