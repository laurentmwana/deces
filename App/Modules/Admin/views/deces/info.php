<?php
$title = 'Contact';
$active = true;
?>
<!-- section  -->
<section class="section ">
    <div class="section-header">
        <h1 class="title letter-gras">Information sur ...</h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title">  Laurent mwana <span class="fa fa-smile"></span></h1>
        <span class="line-left"></span>
    </div>
    <div class="section-user">
        <ul class="user-box">
            <li class="user-info"> Nom : </li>
            <li class="user-info">
            <?= $info[0]->name  ?>  <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>
        <ul class="user-box">
            <li class="user-info"> Postnom : </li>
            <li class="user-info">
            <?= $info[0]->name  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        <ul class="user-box">
            <li class="user-info"> Prénom : </li>
            <li class="user-info">
            <?= $info[0]->lastname  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>


        <ul class="user-box">
            <li class="user-info"> Date du décè : </li>
            <li class="user-info">
            <?= $info[0]->date_d  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        
        <ul class="user-box">
            <li class="user-info"> Date de naissance : </li>
            <li class="user-info">
            <?= $info[0]->happy  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        
        <ul class="user-box">
            <li class="user-info"> Lieu de naissance : </li>
            <li class="user-info">
            <?= $info[0]->happy_l  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        <ul class="user-box">
            <li class="user-info"> Sexe : </li>
            <li class="user-info">
            <?= $info[0]->sexe  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

      <div class="user-action-right">
        <a href="" class="link-dark"><span class="fa fa-user-edit"></span> éditer mon profil</a>
        <a href="" class="link-dark"><span class="fa fa-trash"></span> Supprimer le compte</a>
      </div>
        
  </div>
    
</section>
<!-- end section  -->