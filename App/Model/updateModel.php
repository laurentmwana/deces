<?php

namespace App\Model;

use App\Controller\Post;
use App\Framework\Tables\DecesTable;
use App\Helpers\Helpers;

class updateModel extends Model {
    

    /**
     * @var Post
     */
    private Post $posts;

    /**
     * @param array $keys
     */
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param mixed $table
     * @param mixed $class
     * 
     * @return bool
     */
    public function updateDeces (string $table, array $parameter): bool {
        return $this->query()->update("update")
        ->from($table)
        ->datetime("updatedate", "NOW()")
        ->set('name','lastname', 'happy', 'date_d', 'happy_l', 'maried_q', 'sexe',
        'cause', 'firtsname')
        ->where("id = :id")
        ->values([
            ":id" => $parameter[0]->id,
            ':name' => $this->posts->echap('name')->get('name'),
            ':lastname' => $this->posts->echap('lastname')->get('lastname'),
            ':firtsname' => $this->posts->echap('firtsname')->get('firtsname'),
            ':happy' => $this->posts->echap('happy')->get('happy'),
            ':happy_l' => $this->posts->echap('happy-l')->get('happy-l'),
            ':date_d' => $this->posts->echap('date-d')->get('date-d'),
        
            ':maried_q' => $this->posts->echap('maried-q')->get('maried-q'),
            ':cause' => $this->posts->echap('cause')->get('cause'),
            ':sexe' => $this->posts->echap('sexe')->get('sexe')
        ])
        ->execute();
    }


    /**
     * @param string $table
     * @param array $parameter
     * 
     * @return bool
     */
    public function updateCauses (string $table, array $parameter): bool {
        return $this->query()->update("update")
        ->from($table)
        ->datetime("updatedate", "NOW()")
        ->set("cause", "reference", "categorie_id")
        ->where("id = :id")
        ->values([
            ":id" => $parameter[0]->id,
            ":cause" => $this->posts->echap("cause")->get("cause"),
            ":reference" => Helpers::formate($this->posts->echap("cause")->get("cause")),
            ":categorie_id" => $this->posts->echap("categorie")->get("categorie")
        ])->execute();
    }


    /**
     * @param string $table
     * @param array $parameter
     * 
     * @return bool
     */
    public function updateCategorie (string $table, array $parameter): bool {
        return $this->query()->update("update")->from($table)->set("categorie", "statut")
        ->datetime('createdate', "NOW()")->datetime("updatedate", "NOW()")
        ->where("id = :id")
        ->from('categories')
        ->values([
            ':categorie' => $this->posts->echap('categorie')->get('categorie'),
            ':statut' => $this->posts->echap('statut')->get('statut'),
            ':id' => $parameter[0]->id
        ])->execute();
    }
}