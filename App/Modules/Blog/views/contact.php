<?php

use App\HTML\Form;

$title = 'Contact';
$active = true;

$forms = new Form();

?>
<!-- section contact -->
<section class="section contact">
    <div class="section-header">
        <h1 class="title letter-gras">Nous contacter</h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> Vous pouvez nous contacter <span class="fa fa-smile"></span></h1>
        <span class="line-left"></span>
    </div>
    <div class="content-form center">
        <form action="" class="form">
            <div class="input-group">
                <div class="input">
                <?= $forms->form('input')
                ->id('name')
                ->name('name')
                ->type('text')
                ->label("Entrer votre nom : ")
                ->placeholder("votre nom ex : laurent")
                ->generate() ?>
                </div>
                <div class="input">
                <?= $forms->form('input')
                ->id('lastname')
                ->name('lastname')
                ->type('text')
                ->label("Entrer votre prénom : ")
                ->placeholder("votre nom ex : laurent")
                ->generate() ?>
                </div>
            </div>
            <div class="input-group">
                <div class="input">
                <?= $forms->form('input')
                ->id('name')
                ->name('name')
                ->type('text')
                ->label("Que voulez-vous ? ")
                ->placeholder("votre nom ex : je demande de l'aide")
                ->generate() ?>
                </div>
                <div class="input">
                <?= $forms->form('input')
                ->id('name')
                ->name('name')
                ->type('email')
                ->label("Entrer votre e-mail : ")
                ->placeholder("votre nom ex : laurent@gmail.com")
                ->generate() ?>
                </div>
            </div>
            <div class="input-group-c">
                <?= $forms->form('textarea')
                ->id('name')
                ->name('name')
                ->label(" Le message  : ")
                ->placeholder("votre messgae ex : je suis à la recherhe de...")
                ->generate() ?>
            </div>

            <div class="button-group">
            <?= $forms->form('button')
            ->id('name')
            ->name('name')
            ->type('submit')
            ->label("Sauvegarder")->icon('fa fa-save')
            ->generate() ?>

            <?= $forms->form('button')
            ->type('reset')
            ->label("Nettoyer")->icon('fa fa-smile')
            ->generate() ?>
            </div>
        </form>
    </div>
</section>
<!-- end section contact -->