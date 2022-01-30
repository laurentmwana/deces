<?php

use App\HTML\Form;


$title = 'categorie-modifier';
$active = true;
$forms = new Form($updateMessage);

?>
<!-- section contact -->
<section class="section contact">
    <div class="section-header">
        <h1 class="title letter-gras">Editer une categorie<span class=" fa fa-smile"></span> </h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> <?= $update[0]->categorie  ?> <span class="fa fa-smile"></span> </h1>
        <span class="line-left"></span>
    </div>
    <div class="content-form center">
    <form action="" class="form" method="POST">
            <div class="input-group-c">
                <?= $forms->form('input')->setValues($update[0]->categorie)
                ->id('categorie')
                ->name('categorie')
                ->type('text')
                ->label("Nom de la categorie : ")
                ->placeholder("ex cancer")
                ->generate() ?>
                
            </div>

            <div class="input-group-c">
            <?= $forms->form("select")->placeholder("statut de la categorie")
            ->id("statut")->name("statut")->label("statut de la categorie : ")
            ->option("Contagieuse", "Contagieuse")->setValues($update[0]->statut)
            ->option("virus", "virus")
            ->option("normal", "normal")
            ->generate()
            ?>
            </div>

            <div class="button-group">
            <?= $forms->form('button')
            ->id('categorie-update')
            ->name('categorie-update')
            ->type('submit')
            ->label("Ajouter")->icon('fa fa-save')
            ->generate() ?>
            </div>
        </form>
    </div>
</section>
<!-- end section contact -->