<?php
$title = 'listing de la categorie';
$active = true;
?>
<!-- section  -->
<section class="section ">
    <div class="section-header">
        <h1 class="title letter-gras">Information sur ...</h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title"> <?= $info[0]->categorie  ?> <span class="fa fa-smile"></span></h1>
        <span class="line-left"></span>
    </div>
    <div class="section-user">
        <ul class="user-box">
            <li class="user-info"> Nom de la categorie : </li>
            <li class="user-info">
            <?= $info[0]->categorie  ?>  <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>
        <ul class="user-box">
            <li class="user-info"> Postnom : </li>
            <li class="user-info">
            <?= $info[0]->statut  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        
        <ul class="user-box">
            <li class="user-info"> date de création : </li>
            <li class="user-info">
            <?= $info[0]->createdate  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        <ul class="user-box">
            <li class="user-info"> dernière modification : </li>
            <li class="user-info">
            <?= $info[0]->updatedate  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

      <div class="user-action-right">
        <a href="" class="link-dark"><span class="fa fa-user-edit"></span> éditer mon profil</a>
        <a href="" class="link-dark"><span class="fa fa-trash"></span> Supprimer le compte</a>
      </div>
        
  </div>
    
</section>
<!-- end section  -->