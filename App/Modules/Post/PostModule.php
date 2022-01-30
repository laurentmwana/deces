<?php

namespace App\Framework\Modules\Blog;


/**
 * [Description PostModule]
 */
class PostModule {
    
    /**
     * @var \Framework\Renderer
     */
    private $renderer;

    /**
     * @param \Framework\Router\Router $route
     * @param \Framework\Renderer $renderer
     */
    public function __construct(\App\Framework\Router\Router $route, \App\Framework\Renderer $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->layout("layout#layout");
        $route
            ->get("/post", [$this, "home"], "post.")
            ->get("/post/deces/add", [$this, "deces"], "deces.add")
            ->post("/post/deces/add", [$this, "deces"], "deces.add")
            ->get("/blog/contact", [$this, "contact"], "contact");
        
    }

    /**
     * @return mixed
     */
    public function home () {
        return $this->renderer->render(
            'home',
            '?@views@'
        );
    }

    /**
     * @return mixed
     */
    public function contact () {
        return $this->renderer->render(
            'contact',
            '?@views@'
        );
    }

    /**
     * @return mixed
     */
    public function deces () {
        return $this->renderer->render(
            'deces',
            '?@views@'
        );
    }
}