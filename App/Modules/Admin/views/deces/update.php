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
        <h1 class="title letter-gras">Modification de ... <span class=" fa fa-smile"></span> </h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> <?= $update[0]->name  ?> <span class="fa fa-smile"></span> <?= $update[0]->lastname  ?></h1>
        <span class="line-left"></span>
    </div>
    <div class="content-form center">
    <form action="" class="form" method="POST">
            <div class="input-group-c">
                <?= $forms->form('input')
                ->id('name')
                ->name('name')->setValues($update[0]->name)
                ->type('text')
                ->label("Nom : ")
                ->placeholder("Nom : ex mwanamputu")
                ->generate() ?>
                
            </div>
            <div class="input-group">
                <div class="input">
                <?= $forms->form('input')
                ->id('firtsname')->setValues($update[0]->firtsname)
                ->name('firtsname')
                ->label(" Postnom  : ")
                ->placeholder("postnom : ex labeya")
                ->generate() ?>
                </div>
                <div class="input">
                <?= $forms->form('input')->setValues($update[0]->lastname)
                ->id('lastname')
                ->name('lastname')
                ->type('text')
                ->label("Prénom : ")
                ->placeholder("ex : beya")
                ->generate() ?>
                </div>
            </div>
            
            <div class="input-group">
                <div class="input">
                <?= $forms->form('input')
                ->id('happy')
                ->name('happy')->setValues($update[0]->happy)
                ->type('date')
                ->label("date de naissance : ")
                ->placeholder("ex : 25/02/2022 ")
                ->generate() ?>
                </div>
                <div class="input">
                <?= $forms->form("select")->setValues($update[0]->happy_l)
                ->id("happy-l")->name("happy-l")->label("lieu de naissance: ")->placeholder("Où étes-vous né ? ")
                ->option("Congo(RDC)", "Congo(RDC)")
                ->option("Congo(Brazza)", "Congo(Brazza)")
                ->option("France", "France")
                ->option("Portugal", "Portugal")
                ->option("Angola", "Angola")
                ->generate()
                ?>
                </div>
            </div>
            <div class="input-group">
                <div class="input">
                <?= $forms->form("select")->setValues($update[0]->maried_q)
                ->id("maried-q")->name("maried-q")->label("Etat civil ")->placeholder("Etes-vous marié(e) ?")
                ->option("celibataire", "celibataire")->option("marie", "marié(e)")
                ->option("Divorce", "Divorcé")
                ->generate()
                ?>
                </div>
                <div class="input">
                <?= $forms->form("select-data")->setValues($update[0]->cause)->v('cause', "reference")
                ->id("cause")->name("cause")->label("La cause du décès :")->placeholder("Quelle était la cause de sa mort ?")
                ->dataOption("cause", (new ListingModel())->selected("causes", CauseTable::class))
                ->generate() ?>
                </div>
            </div>

            <div class="input-group">
                <div class="input">
                    <?= $forms->form("select")->setValues($update[0]->sexe)
                    ->id("sexe")->name("sexe")->label("sexe")->placeholder("Quel est votre sexe ?")
                    ->option("Femme", "Femme")->option("Homme", "Homme")
                    ->generate()
                    ?>
                </div>
                <div class="input">
                <?= $forms->form('input')->setValues($update[0]->date_d)
                ->id('date-d')
                ->name('date-d')
                ->type('date')
                ->label("date du décè : ")
                ->placeholder("ex : 31/12/2021")
                ->generate() ?>
                </div>
            </div>

            <div class="button-group">
            <?= $forms->form('button')
            ->id('dece-add')
            ->name('dece-update')
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
