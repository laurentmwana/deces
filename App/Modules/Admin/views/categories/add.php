<?php

use App\FlashMessage;
use App\HTML\Form;

$title = 'cause-categorie';
$active = true;

$flash = new FlashMessage($adds);

$forms = new Form($adds);

?>
<!-- section contact -->
<section class="section contact">
    <div class="section-header">
        <h1 class="title letter-gras">Ajouter une categorie </h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> Qui est mort(e) <span class="fa fa-smile"></span></h1>
        <span class="line-left"></span>
    </div>
    <?php if (isset($adds['success'])): ?>
        <?= $flash->message() ?>
    <?php endif ?>
    <div class="content-form center">
        <form action="" class="form" method="POST">
            <div class="input-group-c">
                <?= $forms->form('input')
                ->id('categorie')
                ->name('categorie')
                ->type('text')
                ->label("Nom de la categorie : ")
                ->placeholder("ex: cancer")
                ->generate() ?>
                
            </div>

            <div class="input-group-c">
            <?= $forms->form("select")->placeholder("statut de la categorie")
            ->id("statut")->name("statut")->label("statut de la categorie : ")
            ->option("Contagieuse", "Contagieuse")
            ->option("virus", "virus")
            ->option("normal", "normal")
            ->generate()
            ?>
            </div>

            <div class="button-group">
            <?= $forms->form('button')
            ->id('categorie-add')
            ->name('categorie-add')
            ->type('submit')
            ->label("Ajouter")->icon('fa fa-save')
            ->generate() ?>
            </div>
        </form>
    </div>
</section>
<!-- end section contact -->