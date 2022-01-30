<?php

namespace App\Controller;

use App\Tables\Builder\QueryBuilder;

class Search {

    /**
     * @var array
     */
    private $search = [];

    /**
     * @var QueryBuilder
     */
    private $query;

    /**
     * @param array $search
     */
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function search ($like): QueryBuilder {
        
        $builder = $this->query;
        $post = new Post;
        Post::method($_GET, "GET");

        if ($post->status("search") && !empty($post->get("q"))) {
            return $this->query->where("{$like} LIKE :{$like}")->values([
                ":{$like}" => "%" . $post->echap('q')->get('q') . "%"
            ]);
        }











        return $builder;




    }

}