<?php

use App\Controller\Paginates;
use App\Controller\Search;
use App\FlashMessage;
use App\Tables\CauseTable;
use App\HTML\Form;
use App\Model\Model;

use App\Session\Session;

$title = 'cause de décès';
$active = true;

$message = new FlashMessage(Session::getSession()->get('flash'));



$dataCauses = (new Search(
    (new Model())->query()->from("causes")
    ->setClass(CauseTable::class)
    ->select("causes.*, categories.statut,categories.categorie")
    ->join("INNER JOIN categories", "causes")
    ->on("categories.id = causes.categorie_id", "causes")
    ->orderBy("id DESC")
))->search("categorie");


$paginate = new Paginates($dataCauses);

$form = new Form();

$items = $paginate->getItems();
?>
<section class="section">
<div class="section-header">
    <h1 class="title letter-gras">Les causes des décès</h1>
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
        <a href="<?= $route->GenerateUri('causes.add') ?>" class="link-dark"><span class="fa fa-plus"></span> Ajouter</a>
        <a href="<?= $route->GenerateUri('deces') ?>" class="link-dark"><span class="fa fa-table"></span> décès</a>
    </div>
    <div class="link-group">
    <a href="<?= $route->GenerateUri('categorie.add') ?>" class="link-dark"><span class="fa fa-plus"></span> Ajouter une categorie</a>
    <a href="<?= $route->GenerateUri('categories') ?>" class="link-dark"><span class="fa fa-table"></span> Categories</a>
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
                <th>cause</th>
                <th>référence</th>
                <th>categorie</th>
                <th>date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
        <?php foreach($items as $cause): ?>
            <tr class="cel">
                <td><?= $cause->id  ?></td>
                <td><?= $cause->cause ?></td>
                <td><?= $cause->reference ?></td>
                <td><?= $cause->categorie ?> ~ <?= $cause->statut ?></td>
                <td><?= $cause->createdate ?></td>
                <td>
                    <div class="group-btn">
                        <a href="<?= $route->GenerateUri("causes.delete", 
                        [ 'id' => $cause->id, 'cause' => $cause->cause, 'reference' => $cause->reference]
                        )  ?>" class="b-dark">
                        <span class="fa fa-trash"></span>
                        </a>
                        <a href="<?= $route->GenerateUri("causes.update", [
                            'id' => $cause->id, 'cause' => $cause->cause, 'reference' => $cause->reference
                        ])  ?>" class="b-dark">
                        <span class="fa fa-edit"></span>
                        </a>
                        <a href="<?= $route->GenerateUri("causes.info", 
                        ['id' => $cause->id, 'cause' => $cause->cause, 'reference' => $cause->reference
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