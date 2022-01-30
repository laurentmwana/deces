<?php

namespace App\Model;

use App\Controller\Post;
use App\Helpers\Helpers;
use App\Model\Model;

class insertModel  extends Model {

    /**
     * @var Post
     */
    private Post $posts;

    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }


    /**
     * @return bool
     */
    public function insertDece (): bool {
        $insert =  $this->query()
        ->insert()
        ->set(
            'name','lastname', 'happy', 'date_d', 'happy_l',  'maried_q', 'sexe',
            'cause', 'firtsname'
        )
        ->datetime('datecreate', "NOW()")
        ->datetime("updatedate", "NOW()")
        ->from('dead')
        ->values([
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

        return $insert;

    } 


    /**
     * @return bool
     */
    public function insertCause (): bool {
        return $insert =  $this->query()
        ->insert()
        ->set(
            "cause", "reference", "categorie_id"
        )
        ->datetime('createdate', "NOW()")
        ->datetime("updatedate", "NOW()")
        ->from('causes')
        ->values([
            ':cause' => $this->posts->echap('cause')->get('cause'),
            ':categorie_id' => $this->posts->echap('categorie')->get('categorie'),
            ':reference' => Helpers::formate($this->posts->echap('cause')->get('cause'))
        ])
        ->execute();

    } 

    /**
     * @return bool
     */
    public function insertCategorie (): bool {
        return $this->query()
        ->insert()
        ->set(
            "categorie", "statut"
        )
        ->datetime('createdate', "NOW()")
        ->datetime("updatedate", "NOW()")
        ->from('categories')
        ->values([
            ':categorie' => $this->posts->echap('categorie')->get('categorie'),
            ':statut' => $this->posts->echap('statut')->get('statut')
        ])
        ->execute();

    } 
}