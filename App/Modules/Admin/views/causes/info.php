<?php
$title = 'Contact';
$active = true;
?>
<!-- section  -->
<section class="section ">
    <div class="section-header">
        <h1 class="title letter-gras">La cause ...</h1>
        <div class="line"></div>
    </div>
    <div class="content-header">
        <h1 class="title">  <?= $info[0]->cause ?> <span class="fa fa-smile"></span></h1>
        <span class="line-left"></span>
    </div>
    <div class="section-user">
        <ul class="user-box">
            <li class="user-info"> Cause du décès : </li>
            <li class="user-info">
            <?= $info[0]->cause  ?>  <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        <ul class="user-box">
            <li class="user-info"> référence : </li>
            <li class="user-info">
            <?= $info[0]->reference  ?> 
            </li>
        </ul>


        <ul class="user-box">
            <li class="user-info"> Date de création : </li>
            <li class="user-info">
            <?= $info[0]->createdate  ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

        
        <ul class="user-box">
            <li class="user-info"> Dérnière modification : </li>
            <li class="user-info">
            <?= $info[0]->updatedate ?> <a href="" class="link_"><span class="fa fa-edit"></span></a>
            </li>
        </ul>

      <div class="user-action-right">
        <a href="" class="link-dark"><span class="fa fa-user-edit"></span> Modifier</a>
        <a href="" class="link-dark"><span class="fa fa-trash"></span> Supprimer</a>
      </div>
        
  </div>
    
</section>
<!-- end section  -->