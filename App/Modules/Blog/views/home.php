<?php

use App\Tables\DecesTable;
use App\Model\Model;

$title = 'page d\'accueil';
$active = true;

$male = (new Model())->query()->from("dead")
->setClass(DecesTable::class)
->select("dead.*", "categories.categorie", "causes.cause")
->join("INNER JOIN causes", "causes")
->join("INNER JOIN categories", "categories")
->on("causes.reference = dead.cause", "causes")
->on("causes.categorie_id = categories.id", "categories")
->where("dead.sexe = :sexe")->values([
  ":sexe" => "Homme"
])->execute();

$female = (new Model())->query()->from("dead")
->setClass(DecesTable::class)
->select("dead.*", "categories.categorie", "causes.cause")
->join("INNER JOIN causes", "causes")
->join("INNER JOIN categories", "categories")
->on("causes.reference = dead.cause", "causes")
->on("causes.categorie_id = categories.id", "categories")
->where("dead.sexe = :sexe")->values([
  ":sexe" => "Femme"
])->execute();

$countMale = count($male);
$countFemale = count($female);

$femme = $countFemale > 1 ? "Femmes" : "Femme";
$homme = $countMale > 1 ? "Hommes" : "Homme";

?>
<section class="section">
  <div class="section-header">
    <h1 class="title letter-gras">Combien des morts ?</h1>
    <div class="line"></div>
  </div>
  <div class="section-stat">
    <div class="stat">
      <div class="s-header"><?= $homme ?> <span class="fa fa-male"></span></div>
      <div class="s-content">
       &emsp; &laquo;  &emsp; <?= $countMale  ?> décès   &emsp; &raquo;
      </div>
    </div>
    <div class="stat">
      <div class="s-header"><?= $femme ?> <span class="fa fa-female"></span></div>
      <div class="s-content">
       &emsp; &laquo;  &emsp;  <?= $countFemale  ?> décès  &emsp; &raquo; 
      </div>
    </div>
  </div>
  <div class="section-stat">
  <div class="stat full">
      <div class="s-header"><?= $homme ?>  <span class="fa fa-male"></span>&emsp14;  + &emsp14;<?= $femme ?> <span class="fa fa-female"></span></div>
      <div class="s-content">
       &emsp; &laquo;  &emsp; <?= ($countFemale + $countMale)  ?> décès   &emsp; &raquo;
      </div>
    </div>
  </div>
</section>