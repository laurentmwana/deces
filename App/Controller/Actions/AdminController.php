<?php


namespace App\Controller\Actions;

use App\Controller\Post;
use App\Header;
use App\Model\existModel;
use App\Model\infoModel;
use App\Model\insertModel;
use App\Model\Model;
use App\Model\updateModel;
use App\Routes\Router;
use App\Session\Session;
use App\Tables\CategoriesTable;
use App\Tables\CauseTable;
use App\Tables\DecesTable;
use App\Validator\Validator;

class AdminController {

    /**
     * @var Router
     */
    private Router $route;

    /**
     * @param Router $route
     */
    public function __construct(Router $route)
    {
        $this->route = $route;
    }

    /**
     * Ajouter un nouveau décès 
     * 
     * @return array
     */
    public function decesAdd (): array {

        Post::method($_POST);
        $post = new Post();

        if ($post->status('dece-add')) {
            
            $validator = new Validator($post);

            // changer les names à l'affichage
            $validator
            ->replace("name", "nom")
            ->replace('lastname', "prénom")
            ->replace('firtsname', "postnom")
            ->replace('maried-q', "était-il(elle) marié ")
            ->replace("happy-l", "Lieu de naissance")
            ->replace("date-d", "date du décès")
            ->replace('sexe', "sexe")
            ->replace("happy", "date de naissance")
            ->replace('cause', 'la cause du décès ');

            // validation pour le champs name
            $validator
            ->empty('name')
            ->lenghtMax('name', 12)
            ->lenghtMin('name', 3)
            ->regex("(^[a-zA-Z_]+$)", 'name');
            
            // validation pour le champs firstname
            $validator
            ->empty('firtsname')
            ->lenghtMax('firtsname', 12)
            ->lenghtMin('firtsname', 3)
            ->regex("(^[a-zA-Z_]+$)", 'firtsname');

               // validation pour le champs lastname
               $validator
               ->empty('lastname')
               ->lenghtMax('lastname', 12)
               ->lenghtMin('lastname', 3)
               ->regex("(^[a-zA-Z_]+$)", 'lastname');

            // validation pour le champs happy (date de naissance)
            $validator
            ->empty('happy')
            ->isdate('happy')
            ->lenghtMax('happy', 12)
            ->lenghtMin('happy', 3);

            // validation pour le champs happy-l (lieu de naissance)
            $validator
            ->empty('happy-l')
            ->lenghtMax('happy-l', 12)
            ->lenghtMin('happy-l', 3);

            // validation pour le champs maried-q (etait-il(elle) marié(e))
            $validator
            ->empty('maried-q')
            ->lenghtMax('maried-q', 12)
            ->lenghtMin('maried-q', 3);

            // validation pour le champs sexe 
            $validator
            ->empty('sexe')
            ->lenghtMin('sexe', 5)->lenghtMax("sexe", 5);

            // validation pour le champs date-d (date du décès)
            $validator
            ->empty('date-d')
            ->lenghtMax('date-d', 10)
            ->isdate('date-d')
            ->lenghtMin('date-d', 10);

            // validation pour le champs cause(cause du décès)
            $validator
            ->empty('cause');
            
            $formate = [];

            if ($validator->isValid()) {
                $insert = new insertModel($post);
                $exist = new existModel ($post);
                if ($exist->existDeces(DecesTable::class)) {
                    $formate['danger'] = [
                        'name' => "Le nom <strong>{$post->get('name')}</strong> existe déjà",
                        'lastname' => "Le prénom <strong>{$post->get('lastname')}</strong> existe déjà",
                        'firtsname' => "Le postnom <strong>{$post->get('firtsname')}</strong> existe déjà"
                    ];
                } else {
                    if($insert->insertDece()) {
                        Session::getSession()->set("success", "<span class='fa fa-check'></span> Vous avez ajouter une nouvelle décès dans la liste");
                        Header::redirect($this->route->GenerateUri("deces"));
                    } 
                }
                
                
            } else {
                $formate['danger'] = $validator->getError();
            }

            return $formate;
        }

        return [];
    }

    /**
     * Permet de suppremer une ligne d'information 
     * 
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $id
     * 
     * @return array
     */
    public function decesDelete ($name, $firtsname, $lastname,  $id): void {
        $delete = $this->getDeces($name, $firtsname, $lastname, $id);

        if ($this->delete("dead", $delete[0]->id)) {
            Session::getSession()->set("success", "<span class='fa fa-check'></span> '{$name} {$firtsname}'a été supprimer de la liste avec succès");
            Header::redirect($this->route->GenerateUri("deces"));
        } else {
            Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Une erreur est survenue");
            Header::redirect($this->route->GenerateUri("deces"));
        }
    }

    /**
     * Permet de modifier une ligne d'information
     * 
     * @param mixed $id
     * @param mixed $firtsname
     * @param mixed $name
     * 
     * @return array
     */
    public function decesUpdate ($name, $firtsname, $lastname, $id): array {
        Post::method($_POST);
        $post = new Post();
        $formate = [];

        if ($post->status('dece-update'))  {

            $validator = new Validator($post);

            // changer les names à l'affichage
            $validator
            ->replace("name", "nom")
            ->replace('lastname', "prénom")
            ->replace('firtsname', "postnom")
            ->replace('maried-q', "était-il(elle) marié ")
            ->replace("happy-l", "Lieu de naissance")
            ->replace("date-d", "date du décès")
            ->replace('sexe', "sexe")
            ->replace("happy", "date de naissance")
            ->replace('cause', 'la cause du décès ');

            // validation pour le champs name
            $validator
            ->empty('name')
            ->lenghtMax('name', 12)
            ->lenghtMin('name', 3)
            ->regex("(^[a-zA-Z_]+$)", 'name');
            
            // validation pour le champs firstname
            $validator
            ->empty('firtsname')
            ->lenghtMax('firtsname', 12)
            ->lenghtMin('firtsname', 3)
            ->regex("(^[a-zA-Z_]+$)", 'firtsname');

               // validation pour le champs lastname
               $validator
               ->empty('lastname')
               ->lenghtMax('lastname', 12)
               ->lenghtMin('lastname', 3)
               ->regex("(^[a-zA-Z_]+$)", 'lastname');

            // validation pour le champs happy (date de naissance)
            $validator
            ->empty('happy')
            ->isdate('happy')
            ->lenghtMax('happy', 12)
            ->lenghtMin('happy', 3);

            // validation pour le champs happy-l (lieu de naissance)
            $validator
            ->empty('happy-l')
            ->lenghtMax('happy-l', 12)
            ->lenghtMin('happy-l', 3);

            // validation pour le champs maried-q (etait-il(elle) marié(e))
            $validator
            ->empty('maried-q')
            ->lenghtMax('maried-q', 12)
            ->lenghtMin('maried-q', 3);

            // validation pour le champs sexe 
            $validator
            ->empty('sexe')
            ->lenghtMin('sexe', 5)->lenghtMax("sexe", 5);

            // validation pour le champs date-d (date du décès)
            $validator
            ->empty('date-d')
            ->lenghtMax('date-d', 10)
            ->isdate('date-d')
            ->lenghtMin('date-d', 10);

            // validation pour le champs cause(cause du décès)
            $validator
            ->empty('cause');
            
            if ($validator->isValid()) {
                $parameter = $this->getDeces($name, $firtsname, $lastname, $id);

                $update = (new updateModel($post))
                ->updateDeces("dead", $parameter);

                if ($update) {
                    Session::getSession()->set("success", "<span class='fa fa-check'></span> Les informations suivantes (nom : {$name}, postnom : {$firtsname}, prénom : {$lastname} ...) ont été changer en (nom : {$post->get('name')}, postnom : {$post->get('firtsname')}, prénom : {$post->get('lastname')}) ...");
                    Header::redirect($this->route->GenerateUri("deces"));
                } else {
                    Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Une erreur est survenue");
                    Header::redirect($this->route->GenerateUri("deces"));
                }
                
            } 
            
            else {
                $formate['danger'] = $validator->getError();
            }
        }

        return $formate;
    }

    /**
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $lastname
     * @param mixed $id
     * 
     * @return array
     */
    public function getDeces ($name, $firtsname, $lastname,  $id): array {

        return (new Model())->query()->from("dead")
        ->setClass(DecesTable::class)
        ->select("dead.*", "categories.categorie", "causes.cause")
        ->join("INNER JOIN causes", "causes")
        ->join("INNER JOIN categories", "categories")
        ->on("causes.reference = dead.cause", "causes")
        ->on("causes.categorie_id = categories.id", "categories")
        ->where("name = :n")->where("firtsname = :f")
        ->where("lastname = :l")
        ->where("dead.id = :id")->values([
            ":n" => $name,
            ":f" => $firtsname,
            ":l" => $lastname,
            ":id" => $id
        ])->execute();
    }






    /**
     * Listing de la table cause 
     * 
     * @param mixed $cause
     * @param mixed $reference
     * @param mixed $id
     * 
     * @return array
     */
    public function causesInfo ($cause, $reference, $id): array {
        
        $info = (new infoModel([
           "id" => $id,
           "cause" => $cause,
           "reference" => $reference,
        ]))->selectInfoCauses("causes", CauseTable::class);
    
        if (!empty($info)) {
            return $info;
        } else if ($info === false) {
            Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> {$cause} {$reference} $id} n'existe pas ou son identifiant a été modifier ");
            Header::redirect($this->route->GenerateUri("deces"));
        }
        

        return [];
    }


    /**
     * Ajouter une cause 
     * @return array
     */
    public function causesAdd (): array {

        Post::method($_POST);
        $post = new Post();
        $formate = [];

        if ($post->status('cause-add')) {

            $validator = (new Validator($post));


            // changer les names à l'affichage
            $validator
            ->replace("cause", "cause de décès")
            ->replace("categorie", "categorie de la cause");
            // validation pour le champs cause de décès
            $validator->empty('cause')
            ->lenghtMax('cause', 12)
            ->lenghtMin('cause', 3)
            ->regex("(^[a-zA-Z_-]+$)", 'cause');

            $validator->empty('categorie')->regex("(^[0-9]+$)", "categorie");

          
            
            if ($validator->isValid()) {
                $insert = new insertModel($post);
                $exist = new existModel ($post);
                if ($exist->existCause(CauseTable::class)) {
                    $formate['danger'] = [
                        'cause' => "La cause du décès  <strong>{$post->get('cause')}</strong> existe déjà"
                    ];
                } else {
                    if($insert->insertCause()) {
                        Session::getSession()->set("success", "<span class='fa fa-check'></span> Vous avez une cause de  décès dans la liste");
                        Header::redirect($this->route->GenerateUri("causes"));
                    } 
                }

                
            }  else {
                $formate['danger'] = $validator->getError();
            }

            return $formate;
        }

        return [];
    }

    /**
     * Permet de suppremer une ligne d'information de la table cause
     * 
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $id
     * 
     * @return array
     */
    public function causeDelete ($cause, $reference, $id): void {
        
        $check = $this->getCauses($cause, $reference, $id);
        if ($this->delete("causes", $check[0]->id)) {
            Session::getSession()->set("success", "<span class='fa fa-check'></span> '{$cause}' a été supprimer de la liste avec succès");
            Header::redirect($this->route->GenerateUri("causes"));
        } else {
            Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Une erreur est survenue");
            Header::redirect($this->route->GenerateUri("causes"));
        }
    }


    /**
     * Permet de modifier une ligne d'information
     * 
     * @param mixed $id
     * @param mixed $firtsname
     * @param mixed $name
     * 
     * @return array
     */
    public function causesUpdate ($cause, $reference, $id): array {
        Post::method($_POST);
        $post = new Post();
        $formate = [];

        if ($post->status('cause-update'))  {

            $validator = (new Validator($post));
            // changer les names à l'affichage
            $validator->replace("cause", "cause de décès");
            // validation pour le champs cause de décès
            $validator->empty('cause')
            ->lenghtMax('cause', 12)
            ->lenghtMin('cause', 3)
            ->regex("(^[a-zA-Z_-]+$)", 'cause');

            $validator->empty('categorie')->regex("(^[0-9]+$)", "categorie");

          
            
            if ($validator->isValid()) {
                $parameter = $this->getCauses($cause, $reference, $id);

                $update = (new updateModel($post))
                ->updateCauses("causes", $parameter);

                if ($update) {
                    Session::getSession()->set("success", "<span class='fa fa-check'></span> Les informations suivantes (cause du décès : {$cause}, référence : {$reference} ...) ont été changer en (cause : {$post->get('cause')} ...)");
                    Header::redirect($this->route->GenerateUri("causes"));
                } else {
                    Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Une erreur est survenue");
                    Header::redirect($this->route->GenerateUri("causes"));
                }
                
            } 
            
            else {
                $formate['danger'] = $validator->getError();
            }
        }

        return $formate;
    }


   
    /**
     * @param mixed $cause
     * @param mixed $reference
     * @param mixed $id
     * 
     * @return array
     */
    public function getCauses ($cause, $reference, $id): array {

        return (new Model())->query()->from("causes")
        ->setClass(CauseTable::class)
        ->select("causes.*, categories.statut,categories.categorie")
        ->join("INNER JOIN categories", "causes")
        ->on("categories.id = causes.categorie_id", "causes")
        ->setClass(CauseTable::class)
        ->where("cause = :c")->where("reference = :r")
        ->where("causes.id = :id")->values([
            ":c" => $cause,
            ":r" => $reference,
            ":id" => $id
        ])->execute();
    }


    /**
     * @return array
     */
    public function categorieAdd (): array {
        Post::method($_POST);
        $post = new Post();
        $formate = [];

        if ($post->status('categorie-add')) {

            $validator = (new Validator($post));


            // changer les names à l'affichage
            $validator
            ->replace("categorie", "categorie (cause de décès)")
            ->replace("statut", "statut de la categorie");
            // validation pour le champs cause de décès
            $validator->empty('categorie')
            ->lenghtMax('categorie', 12)
            ->lenghtMin('categorie', 3)
            ->regex("(^[a-zA-Z_-]+$)", 'categorie');

            $validator->empty('statut');

          
            
            if ($validator->isValid()) {

                $insert = new insertModel($post);
                $exist = new existModel($post);

                if ($exist->existCategorie(CategoriesTable::class)) {
                    $formate['danger'] = [
                        "categorie" => "Le nom de la categorie   <strong>{$post->get('categorie')}</strong> existe déjà"
                    ];
                } else if ($insert->insertCategorie() && empty($for)) {
                    Session::getSession()->set("success", "<span class='fa fa-check'></span> <strong>{$post->get("categorie")} </strong> a été ajouter dans la  categorie");
                    Header::redirect($this->route->GenerateUri("categories"));
                }
                
            }  else {
                $formate['danger'] = $validator->getError();
            }

            return $formate;
        }

        return [];
    }

    /**
     * @param mixed $categorie
     * @param mixed $status
     * @param mixed $id
     * 
     * @return array
     */
    public function categorieUpdate ($categorie, $status, $id): array {
        Post::method($_POST);
        $post = new Post();
        $formate = [];

        if ($post->status('categorie-update')) {

            $validator = (new Validator($post));


            // changer les names à l'affichage
            $validator
            ->replace("categorie", "categorie (cause de décès)")
            ->replace("statut", "statut de la categorie");
            // validation pour le champs cause de décès
            $validator->empty('categorie')
            ->lenghtMax('categorie', 12)
            ->lenghtMin('categorie', 3)
            ->regex("(^[a-zA-Z_-]+$)", 'categorie');

            $validator->empty('statut');

          
            
            if ($validator->isValid()) {

                $check = $this->getCategorie($categorie, $status, $id);
                if (!empty($check)) {
                   $update = (new updateModel($post))->updateCategorie("categories", $check);

                    if ($update) {
                        Session::getSession()->set("success", "<span class='fa fa-check'></span> Les informations suivantes (cause du décès : {$categorie}, statut : {$status} ...) ont été changer en (cause : {$post->get('categorie')}, statut: {$post->get('statut')}...)");
                        Header::redirect($this->route->GenerateUri("categories"));
                    } else {
                        Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Une erreur est survenue");
                        Header::redirect($this->route->GenerateUri("categories"));
                    }
                   
                } else {
                    Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Les informations suivantes <strong> {$categorie} {$status} </strong> sont introuvable");
                    Header::redirect($this->route->GenerateUri("categories"));
                }
                
            }  else {
                $formate['danger'] = $validator->getError();
            }

            return $formate;
        }

        return [];
    }

    /**
     * @param mixed $categorie
     * @param mixed $status
     * @param mixed $id
     * 
     * @return array
     */
    public function getCategorie ($categorie, $status, $id): array {
        return (new Model())->query()
        ->select("*")->from("categories")
        ->where("categorie = :c")->where("statut = :s")
        ->setClass(CategoriesTable::class)
        ->where("id = :id")->values([
            ":c" => $categorie,
            ":s" => $status,
            ":id" => $id
        ])->execute();
    }

    /**
     * @param mixed $categorie
     * @param mixed $status
     * @param mixed $id
     * 
     * @return void
     */
    public function categorieDelete ($categorie, $status, $id): void {

        $check = $this->getCategorie($categorie, $status, $id);
       
        if (empty($check)) {
           
            Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Les informations suivantes <strong> {$categorie} {$status} </strong> sont introuvable");
            Header::redirect($this->route->GenerateUri("causes"));
        } else {
            if ($this->delete("categories", $check[0]->id)) {
                Session::getSession()->set("success", "<span class='fa fa-check'></span> La categorie  <strong> {$categorie}</strong> a été supprimer  avec succès");
                Header::redirect($this->route->GenerateUri("categories")); 
            } else {
                Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> Une erreur est survenue");
                Header::redirect($this->route->GenerateUri("categories"));
            }
        }
    }

    /**
     * @param mixed $table
     * @param mixed $value
     * 
     * @return bool
     */
    private function delete ($table, $value): bool {
        return (new Model())->query()->from($table)
        ->delete($table)->where("id = :id")->values([
            ":id" => $value
        ])->execute();
    }

 

}