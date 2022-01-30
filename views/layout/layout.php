<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= isset($title) ? $title : "gestion de décès" ?></title>
    <title>Gestion de décès</title>
    <link rel="stylesheet" href="<?= sources('css/app.css')  ?>">
    <link rel="stylesheet" href="<?= sources('vendor/fontawesome/css/all.css') ?>">
    <link rel="stylesheet" href="<?= sources('vendor/fontawesome/css/fontawesome.css')  ?>">
  </head>
  <body>
      <div class="logo-title letter-gras">Gestion de décès</div>
      <div class="menu" id="menu">
          <ul class="items">
            <li class="item"><a href="<?= $route->GenerateUri('home')  ?>" class="link ">Accueil</a></li>
            <li class="item"><a href="<?= $route->GenerateUri('deces')  ?>" class="link ">Décès</a></li>
            <li class="item"> <a href="<?= $route->GenerateUri('causes') ?>" class="link ">Causes</a></li>
            <li class="item"><a href="<?= $route->GenerateUri('categories')  ?>" class="link ">Categories</a></li>
          </ul>

          <ul class="items">
           
            <li class="item">
              <a href="<?= $route->GenerateUri('home') ?>" class="link "><span class="fa fa-user"></span> Mon profil</a>
            </li>
            <li class="item">
              <a href="<?= $route->GenerateUri('home') ?>" class="link "><span class="fa fa-sign-out-alt"></span> Déconnexion</a>
            </li>
          </ul>
      </div>

     <div class="container">
         <?= $content ?>
     </div>

     <!-- footer -->
     <footer class="footer">
      <div class="copy">
          <div class="t-copy">
              &copy; copyright 2022 laurent toute reproduction est autorisée
          </div>
          <div class="d-copy letter-gras">Gestion de décès</div>
      </div>
   </footer>
   <!-- end footer -->
    <script src="<?= sources('vendor/fontawesome/js/all.js') ?>"></script>
    <script src="<?= sources('vendor/fontawesome/js/fontawesome.js') ?>"></script>
    <script src="<?= sources('js/app.js') ?>"></script>
  </body>
</html>
