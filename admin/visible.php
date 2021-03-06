<?php

session_start();
$welcome = "Bienvenue " . $_SESSION['authUser'];
//Connexion base de données
require ('config.php');
//Vérification des droits de connexion
if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
  echo "Vous devez vous connecter.  <a href='login.php'> Connexion.</a>";
  exit;
}





   if($_GET['status']=='visible'){
       $id=intval($_GET['id']);
     $invisible = "masqué";
     mysqli_query($link,"UPDATE post SET visible='$invisible' WHERE id='$id' AND visible='visible';");
   }
   if($_GET['status']=='masqué'){
     $visible = "visible";
     $id=intval($_GET['id']);
     mysqli_query($link,"UPDATE post SET visible='$visible' WHERE id='$id' AND visible='masqué';");
   }



   $msg =  'Visibilité de l\'article modifiée';

?>





<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Editer un article</title>

    <link href="../style/blogadmin.css" rel="stylesheet">
  </head>

  <body>
    <div class="sticky-top">
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index" target="_blank">Bison Factory</a>
      <input class="form-control form-control-dark w-50 d-none d-md-block" type="text" placeholder="Recherche" aria-label="Search">
      <div class="mx-auto">
        <em> <?php echo $welcome?> </em>
      </div>
      <div class="mx-auto">
          <a class="nav-link deconnect" href="deconnexion.php">Déconnexion</a>
      </div>
    </nav>
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap d-md-none">
        <button class="navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="admin.php">Tableau de bord <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../blog.php"  target="_blank">Voir le blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Catégories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Stats</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
            </form>
          </div>
      </li>
    </ul>
  </nav>
</div>



    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky position-fixed" >
            <ul class="nav flex-column">
              <li class="nav-item mt-3">
                <a class="nav-link" href="admin.php">
                  <span data-feather="home"></span>
                  Tableau de bord <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a href='../blog.php' class="nav-link"  target="_blank">
                  <span data-feather="file"></span>
                  Voir le blog
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Catégories
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Stats
                </a>
              </li>
            </ul>

          </div>
        </nav>




          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <br />



            <p><?php if (isset($msg)){
                        echo $msg;
                    }
                    else {
                      echo 'une erreur est survenue.';
                    }
                ?>
            </p>
            <a href='admin.php'> Retour aux articles</a>


          </main>


          <!-- Bootstrap core JavaScript
          ================================================== -->
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

          <!-- Icons -->
          <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
          <script>
            feather.replace()
          </script>

        </body>
      </html>
