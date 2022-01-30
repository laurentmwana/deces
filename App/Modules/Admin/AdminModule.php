<?php

namespace App\Modules\Admin;

use App\Controller\Actions\AdminController;
use App\Header;
use App\Renderer;
use App\Routes\Router;
use App\Session\Session;

/**
 * AdminModule va charger et definir les routes du dossier views 'Admin'
 */
class AdminModule {

    /**
     * @var AdminController
     */
    private AdminController $admin;
    
    /**
     * @var \App\Framework\Renderer
     */
    private $renderer;

    /**
     * @var Router
     */
    private Router $route;

    
    /**
     * AdminModule Constructor 
     *
     * @param Router $route
     * @param Renderer $renderer
     */
    public function __construct(Router $route, Renderer $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->layout("layout#layout");
        $route
            ->get("/admin/profil", [$this, "profil"], "profil")

            ->get("/admin/deces/add", [$this, "decesAdd"], "deces.add")
            ->post("/admin/deces/add", [$this, "decesAdd"], "deces.add")


            ->get("/admin/deces/info/:name/:firtsname/:lastname/:id", [$this, 'decesInfo'], "deces.info")
            ->get("/admin/deces/delete/:name/:firtsname/:lastname/:id", [$this, 'decesDelete'], "deces.delete")

            ->get("/admin/deces/update/:name/:firtsname/:lastname/:id", [$this, "decesUpdate"], "deces.update")
            ->post("/admin/deces/update/:name/:firtsname/:lastname/:id", [$this, "decesUpdate"], "deces.update")
            
            
            ->get("/admin/causes/add", [$this, "causesAdd"], "causes.add")
            ->post("/admin/causes/add", [$this, "causesAdd"], "causes.add")

            ->get("/admin/causes/info/:cause/:reference/:id", [$this, 'causesInfo'], "causes.info")
            ->get("/admin/causes/delete/:cause/:reference/:id", [$this, 'causesDelete'], "causes.delete")

            ->get("/admin/causes/update/:cause/:reference/:id", [$this, "causesUpdate"], "causes.update")
            ->post("/admin/causes/update/:cause/:reference/:id", [$this, "causesUpdate"], "causes.update")

            ->get("/admin/categorie/add", [$this, "categorieAdd"], "categorie.add")
            ->post("/admin/categorie/add", [$this, "categorieAdd"], "categorie.add")

            ->get("/admin/categorie/info/:categorie/:statut/:id", [$this, "categorieInfo"], "categorie.info")
            ->get("/admin/categorie/delete/:categorie/:statut/:id", [$this, "categorieDelete"], "categorie.delete")

            ->get("/admin/categorie/update/:categorie/:statut/:id", [$this, "categorieUpdate"], "categorie.update")
            ->post("/admin/categorie/update/:categorie/:statut/:id", [$this, "categorieUpdate"], "categorie.update");
        $this->route = $route;
        $this->admin = new AdminController($this->route);
    }

    /**
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $lastname
     * @param mixed $id
     * 
     * @return HTML
     */
    public function causesInfo ($cause, $reference, $id) {
        
        $info = $this->admin->causesInfo($cause, $reference, $id);

        return $this->renderer->render(
            'info',
            __DIR__ . '@views@causes@',
            ['info' => $info]
        );
    }

    /**
     * @return mixed
     */
    public function causesAdd () {

        $adds = $this->admin->causesAdd();
        return $this->renderer->render(
            'add',
            __DIR__ . '@views@causes@',
            [
                'adds' => $adds
            ]
        );
    }


    /**
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $id
     * 
     * @return mixed
     */
    public function causesUpdate ($cause, $reference, $id) {
        $update = $this->admin->getCauses($cause, $reference, $id);
        $updateMessage = $this->admin->causesUpdate($cause, $reference, $id);

        return $this->renderer->render(
            'update',
            __DIR__ . '@views@causes@',
            ["update" => $update, "updateMessage" => $updateMessage]
        );
    }


    /**
     * @param mixed $cause
     * @param mixed $reference
     * @param mixed $id
     * 
     * @return void
     */
    public function causesDelete ($cause, $reference, $id) {
        $this->admin->causeDelete($cause, $reference, $id);
    }




    /**
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $lastname
     * @param mixed $id
     * 
     * @return HTML
     */
    public function decesInfo ($name, $firtsname, $lastname, $id) {
        
        $info = $this->admin->getDeces($name, $firtsname, $lastname, $id);

        if (empty($info)) {
            Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> {$name} {$firtsname} {$lastname} {$id} n'existe pas ou son identifiant a été modifier ");
            Header::redirect($this->route->GenerateUri("deces"));
        }

        return $this->renderer->render(
            'info',
            __DIR__ . '@views@deces@',
            ['info' => $info]
        );
    }

    /**
     * @return mixed
     */
    public function decesAdd () {

        $adds = $this->admin->decesAdd();
        return $this->renderer->render(
            'add',
            __DIR__ . '@views@deces@',
            [
                'adds' => $adds
            ]
        );
    }


    /**
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $id
     * 
     * @return mixed
     */
    public function decesUpdate ($name, $firtsname, $lastname, $id) {
        $update = $this->admin->getDeces($name, $firtsname, $lastname, $id);
        $updateMessage = $this->admin->decesUpdate($name, $firtsname, $lastname, $id);

        return $this->renderer->render(
            'update',
            __DIR__ . '@views@deces@',
            ["update" => $update, "updateMessage" => $updateMessage]
        );
    }

    /**
     * @param mixed $name
     * @param mixed $firtsname
     * @param mixed $lastname
     * @param mixed $id
     * 
     * @return void
     */
    public function decesDelete ($name, $firtsname, $lastname,  $id) {
        $this->admin->decesDelete($name, $firtsname,$lastname,  $id);
    }




    /**
     * @return mixed
     */
    public function profil () {
        return $this->renderer->render(
            'profil',
            __DIR__ . '@views@categories@'
        );
    }
    

    /**
     * @return mixed
     */
    public function logout () {
        return $this->renderer->render(
            'logout',
            __DIR__ . '@views@categories@'
        );
    }



    // categorie
    public function categorieAdd () {
        $adds = $this->admin->categorieAdd();
        return $this->renderer->render(
            'add',
            __DIR__ . '@views@categories@', [
                "adds" => $adds
            ]
        );
    }

    public function categorieUpdate ($categorie, $status, $id) {
        $update = $this->admin->getCategorie($categorie, $status, $id);
        $updateMessage = $this->admin->categorieUpdate($categorie, $status, $id);
        return $this->renderer->render(
            'update',
            __DIR__ . '@views@categories@', [
                "update" => $update, "updateMessage" => $updateMessage
            ]
        );
    }

    /**
     * @param mixed $categorie
     * @param mixed $status
     * @param mixed $id
     * 
     * @return void
     */
    public function categorieDelete ($categorie, $status, $id) {
        $this->admin->categorieDelete($categorie, $status, $id);
    }

    public function categorieInfo ($categorie, $status, $id) {
        $info = $this->admin->getCategorie($categorie, $status, $id);
        if ($info === false || empty($info)) {
            Session::getSession()->set("danger", "<span class='fa fa-window-close'></span> {$categorie} {$status}  {$id} n'existe pas ou son identifiant a été modifier ");
            Header::redirect($this->route->GenerateUri("categories"));
        }
        return $this->renderer->render(
            'info',
            __DIR__ . '@views@categories@', [
                "info" => $info
            ]
        );
    }
}
