<?php

use App\Tables\CauseTable;
use App\HTML\Form;
use App\Model\ListingModel;

$title = 'décés-modifier';
$active = true;
$forms = new Form($updateMessage);

?>
<!-- section contact -->
<section class="section contact">
    <div class="section-header">
        <h1 class="title letter-gras">Modification de la cause ... <span class=" fa fa-smile"></span> </h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> <?= $update[0]->cause  ?> <span class="fa fa-smile"></span> <?= $update[0]->reference  ?></h1>
        <span class="line-left"></span>
    </div>
    <div class="content-form center">
        <form action="" class="form" method="POST">
            <div class="input-group-c">
                <?= $forms->form('input')
                ->id('cause')
                ->name('cause')
                ->type('text')->setValues($update[0]->cause)
                ->label("Cause du décès  : ")
                ->placeholder("cause : ex  malaria")
                ->generate() ?>
            </div>
            <div class="input-group-c">
            <?= $forms->form("select-data")->v('categorie', "id")->setValues($update[0]->id)
                ->id("categorie")->name("categorie")->label("La categorie du décès :")->placeholder("Quelle était la cause de sa mort ?")
                ->dataOption("categorie", (new ListingModel())->selected("categories", CauseTable::class))
                ->generate() ?>
            </div>
           
            <div class="button-group">
                <?= $forms->form('button')
                ->id('cause-update')
                ->name('cause-update')
                ->type('submit')
                ->label("Sauvegarder")->icon('fa fa-save')
                ->generate() ?>
            </div>
        </form>
    </div>
</section>
<!-- end section contact -->
