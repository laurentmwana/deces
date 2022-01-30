<?php

namespace App\Model;

use App\Controller\Post;
use App\Helpers\Helpers;
use App\Model\Model;

class existModel  extends Model {

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
    public function existDeces ($class): bool {
        $exist =  $this->query()
        ->select("*")
        ->where("name = :name")
        ->where("firtsname = :firtsname")
        ->where("lastname = :lastname")
        ->setClass($class)
        ->from('dead')
        ->values([
            ':name' => $this->posts->echap('name')->get('name'),
            ':lastname' => $this->posts->echap('lastname')->get('lastname'),
            ':firtsname' => $this->posts->echap('firtsname')->get('firtsname')
        ])->execute();

        if (!empty($exist) && is_array($exist)) {
            return true;
        }

       
        return false;
    } 

    /**
     * @param mixed $class
     * 
     * @return bool
     */
    public function existCause($class): bool {
        $exist =  $this->query()
        ->select("*")
        ->where("cause = :cause")
        ->where("categorie_id = :categorie_id")
        ->where("reference = :reference")
        ->setClass($class)
        ->from('causes')
        ->values([
            ":cause" => $this->posts->echap('cause')->get('cause'),
            ":categorie_id" => $this->posts->echap('categorie')->get('categorie'),
            ":reference" => Helpers::formate($this->posts->echap('cause')->get('cause'))
        ])->execute();
           

        if (!empty($exist) && is_array($exist)) {
            return true;
        }

        return false;
    
    } 


    public function existCategorie ($class): bool {
        $exist =  $this->query()
        ->select("*")
        ->where("categorie = :categorie")
        ->where("statut = :statut")
        ->setClass($class)
        ->from('categories')
        ->values([
            ":categorie" => $this->posts->echap('categorie')->get('categorie'),
            ":statut" => $this->posts->echap('statut')->get('statut')
        ])->execute();
           

        if (!empty($exist) && is_array($exist)) {
            return true;
        }

       
        return false;
        
        
    }
}