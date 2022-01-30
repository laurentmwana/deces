<?php

use App\Controller\Paginates;
use App\Controller\Search;
use App\FlashMessage;
use App\Tables\DecesTable;
use App\HTML\Form;
use App\Model\Model;
use App\Session\Session;

$title = 'décés';
$active = true;

$message = new FlashMessage(Session::getSession()->get('flash'));



$dataDeces = (new Search(
    (new Model())->query()->from("dead")
    ->setClass(DecesTable::class)
    ->select("dead.*", "categories.categorie", "causes.cause")
    ->join("INNER JOIN causes", "causes")
    ->join("INNER JOIN categories", "categories")
    ->on("causes.reference = dead.cause", "causes")
    ->on("causes.categorie_id = categories.id", "categories")
))->search("name");


$paginate = new Paginates($dataDeces,2);

$errors = [];
$form = new Form($errors);

$items = $paginate->getItems();
?>
<section class="section">
<div class="section-header">
    <h1 class="title letter-gras">Décès</h1>
    <div class="line"></div>
</div>

<div class="content-right">
    <form action="" class="form" method="GET">
        <div class="input-inline-group">
            <?= 
            $form->form("input")->setError("q", false)->type("search")->name("q")->id("q")->placeholder("Recherche...")
            ->generate()
            ?>   
            <?= $form->form('button')->id('search')->name('search')
            ->type('submit')->icon('fa fa-search')
            ->generate() ?>
    
        </div>
    </form>
</div>
<div class="content-flex-around">
    <div class="link-group">
        <a href="<?= $route->GenerateUri('deces.add') ?>" class="link-dark"><span class="fa fa-plus"></span> Nouveau</a>
        <a href="<?= $route->GenerateUri('causes.add') ?>" class="link-dark"><span class="fa fa-plus"></span> cause</a>
        <a href="<?= $route->GenerateUri('causes') ?>" class="link-dark"><span class="fa fa-table"></span> causes</a>
    </div>
    <div class="link-group">
        <a href="" class="link-dark"><span class="fa fa-print"></span> Imprimer</a>
    </div>
</div> 

<div class="paginate" data="">
    <div class="link-left"><?= $paginate->previous() ?></div>
    <div class="links"> <?= $paginate->pagine() ?> </div>
    <div class="link-right"><?= $paginate->next() ?></div>
</div>
<?= $message->message() ?>
<hr class="divised">

<div class="content-show">
    <?php if (!empty($items)): ?>
    <table class="table-responsive">
        <thead class="table-header">
            <tr class="cel">
                <th>id</th>
                <th>Nom</th>
                <th>Postnom</th>
                <th>Prénom</th>
                <th>sexe</th>
                <th>Etat civil</th>
                <th>cause du décés</th>
                <th>Date du décès</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php foreach($items as $deces): ?>
            <tr class="cel">
                <td><?= $deces->id  ?></td>
                <td><?= $deces->name ?></td>
                <td><?= $deces->firtsname ?></td>
                <td><?= $deces->lastname ?></td>
                <td><?= $deces->sexe ?></td>
                <td><?= $deces->maried_q ?></td>
                <td><?= $deces->cause ?> ~ <?= $deces->categorie ?></td>
                <td><?= $deces->date_d ?></td>
                <td>
                    <div class="group-btn">
                        <a href="<?= $route->GenerateUri("deces.delete", 
                        [ 'id' => $deces->id, 'name' => $deces->name, 'firtsname' => $deces->firtsname, 'lastname' => $deces->lastname]
                        )  ?>" class="b-dark">
                        <span class="fa fa-trash"></span>
                        </a>
                        <a href="<?= $route->GenerateUri("deces.update", [
                            'id' => $deces->id, 'name' => $deces->name, 'firtsname' => $deces->firtsname, 'lastname' => $deces->lastname
                        ])  ?>" class="b-dark">
                        <span class="fa fa-edit"></span>
                        </a>
                        <a href="<?= $route->GenerateUri("deces.info", 
                        ['id' => $deces->id,'name' => $deces->name,'firtsname' => $deces->firtsname,'lastname' => $deces->lastname
                        ])  ?>" class="b-dark">
                        <span class="fa fa-info-circle"></span>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="message message-secondary">Aucun résultat trouver </div>
    <?php endif ?>
</div>
<div class="paginate" data="">
    <div class="link-left"><?= $paginate->previous() ?></div>
    <div class="links"> <?= $paginate->pagine() ?> </div>
    <div class="link-right"><?= $paginate->next() ?></div>
</div>
</section>