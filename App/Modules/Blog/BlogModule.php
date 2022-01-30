<?php

namespace App\Modules\Blog;

use App\Renderer;
use App\Routes\Router;


/**
 * charger les fichiers qui se trouvent dans le dossier Blog
 */
class BlogModule {
    
    /**
     * @var \Framework\Renderer
     */
    private $renderer;


    /**
     * Undocumented function
     *
     * @param Router $route
     * @param Renderer $renderer
     */
    public function __construct(Router $route, Renderer $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->layout("layout#layout");
        $route
            ->get("/", [$this, "home"], "home")
            ->get("/blog/deces", [$this, "deces"], "deces") ->post("/blog/deces", [$this, "deces"], "deces")

            ->get("/blog/causes", [$this, "causes"], "causes") ->post("/blog/causes", [$this, "causes"], "causes")
            ->get("/blog/categories", [$this, "categories"], "categories") ->post("/blog/categories", [$this, "categories"], "categories")
            ->get("/blog/contact", [$this, "contact"], "contact");
        
    }

    /**
     * @return mixed
     */
    public function home () {
        return $this->renderer->render(
            'home',
            __DIR__ . '@views@'
        );
    }

    /**
     * @return mixed
     */
    public function contact () {
        return $this->renderer->render(
            'contact',
            __DIR__ . '@views@'
        );
    }

    /**
     * @return mixed
     */
    public function deces () {
        return $this->renderer->render(
            'deces',
            __DIR__ . '@views@'
        );
    }

    public function causes () {
        return $this->renderer->render(
            'causes',
            __DIR__ . '@views@'
        );
    }


    public function categories () {
        return $this->renderer->render(
            'categories',
            __DIR__ . '@views@'
        );
    }
}