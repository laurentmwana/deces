<?php

namespace App;


class Renderer {
    
    /**
     * paths
     *
     * @var mixed
     */
    private $paths;

    /**
     * @var string
     */
    private $layout;

    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var array
     */
    private $globals = [];
    
    /**
     * Renderer constructor 
     *
     * @param  string $path
     * @return void
     */
    public function __construct(string $path)
    {
        $this->paths = $path;
    }

    /**
     * @param string $key
     * @param mixed $value
     * 
     * @return void
     */
    public function addGlobals(string $key, $value): void {
        $this->globals[$key] = $value;
    }

    /**
     * @param string $layout
     * 
     * @return void
     */
    public function layout (string $layout): void {
        $this->layout = $layout;
    }

    /**
     * Récupèrer le chemin du fichier puis charge le fichier
     * 
     * @param string $path chemin du fichier 
     * @param array $params les données envoyées
     * 
     * @return mixed
     */
    public function render (string $render, string $path,  array $params = []) {
        $path = str_replace('@', DIRECTORY_SEPARATOR, $path) . $render . '.php';
        $layout = $this->paths . (str_replace("#", DIRECTORY_SEPARATOR, $this->layout) . ".php");
        ob_start();
        extract($params);
        extract($this->globals);
        require ($path);
        http_response_code(200);
        $content = ob_get_clean();
        require ($layout);
    }
}