<?php

use App\Controller\Paginates;
use App\FlashMessage;
use App\HTML\Form;
use App\Model\Model;
use App\Session\Session;
use App\Tables\CategoriesTable;

$title = 'cause de décès';
$active = true;

$message = new FlashMessage(Session::getSession()->get('flash'));

$paginate = new Paginates(
    (new Model())->query()
    ->setClass(CategoriesTable::class)
    ->select("*")->from("categories")
    ->orderBy("createdate DESC")
);

$items = $paginate->getItems();

$form = new Form();
?>
<section class="section">
<div class="section-header">
    <h1 class="title letter-gras">Les categories </h1>
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
        <a href="<?= $route->GenerateUri('categorie.add') ?>" class="link-dark"><span class="fa fa-plus"></span> Ajouter une categorie</a>
        <a href="<?= $route->GenerateUri('deces') ?>" class="link-dark"><span class="fa fa-table"></span> décès</a>
        <a href="<?= $route->GenerateUri('causes') ?>" class="link-dark"><span class="fa fa-table"></span> causes</a>
    </div>
    <div class="link-group">
        <a href="<?= $route->GenerateUri('deces.add') ?>" class="link-dark"><span class="fa fa-plus"></span> Ajouter un décès</a>
        <a href="<?= $route->GenerateUri('causes.add') ?>" class="link-dark"><span class="fa fa-plus"></span> Ajouter une causes</a>
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
                <th>categorie</th>
                <th>statut</th>
                <th>date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
        <?php foreach($items as $categorie): ?>
            <tr class="cel">
                <td><?= $categorie->id  ?></td>
                <td><?= $categorie->categorie ?></td>
                <td><?= $categorie->statut ?></td>
                <td><?= $categorie->createdate ?></td>
                <td>
                    <div class="group-btn">
                        <a href="<?= $route->GenerateUri("categorie.delete", 
                        [ 'id' => $categorie->id, 'categorie' => $categorie->categorie, 'statut' => $categorie->statut]
                        )  ?>" class="b-dark">
                        <span class="fa fa-trash"></span>
                        </a>
                        <a href="<?= $route->GenerateUri("categorie.update", [
                            'id' => $categorie->id, 'categorie' => $categorie->categorie, 'statut' => $categorie->statut
                        ])  ?>" class="b-dark">
                        <span class="fa fa-edit"></span>
                        </a>
                        <a href="<?= $route->GenerateUri("categorie.info", 
                        ['id' => $categorie->id, 'categorie' => $categorie->categorie, 'statut' => $categorie->statut
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