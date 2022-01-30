<?php

use App\FlashMessage;
use App\Tables\CauseTable;
use App\HTML\Form;
use App\Model\ListingModel;

$title = 'cause-ajoute';
$active = true;


$flash = new FlashMessage($adds);
$forms = new Form($adds);

?>
<!-- section contact -->
<section class="section contact">
    <div class="section-header">
        <h1 class="title letter-gras">Cause de décès </h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> exemple d'une cause <strong>malaria</strong></h1>
        <span class="line-left"></span>
    </div>
    <div class="content-flex-around">
        <div class="link-group">
            <a href="<?= $route->GenerateUri('causes') ?>" class="link-dark"><span class="fa fa-table"></span> causes</a>
        </div>
    </div>
    <?php if (isset($adds['success'])): ?>
        <?= $flash->message() ?>
    <?php endif ?>
    <div class="content-form center">
        <form action="" class="form" method="POST">
            <div class="input-group-c">
                <?= $forms->form('input')
                ->id('cause')
                ->name('cause')
                ->type('text')
                ->label("Cause du décès  : ")
                ->placeholder("cause : ex  malaria")
                ->generate() ?>
            </div>
            <div class="input-group-c">
            <?= $forms->form("select-data")->v('categorie', "id")
                ->id("categorie")->name("categorie")->label("La categorie du décès :")->placeholder("Quelle était la cause de sa mort ?")
                ->dataOption("categorie", (new ListingModel())->selected("categories", CauseTable::class))
                ->generate() ?>
            </div>

            <div class="button-group">
            <?= $forms->form('button')
            ->id('cause-add')
            ->name('cause-add')
            ->type('submit')
            ->label("ajouter")->icon('fa fa-plus')
            ->generate() ?>
            </div>
        </form>
    </div>
</section>
<!-- end section contact -->