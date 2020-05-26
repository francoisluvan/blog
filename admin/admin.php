<?php

session_start();

//Vérification de connexion
if (isset($_SESSION['isAdmin'])) {
        $welcome = "Bienvenue " . $_SESSION['authUser'];
    }else {
        echo "Veuillez vous connecter. <br /> <a href='/admin/login.php'> connexion</a>";
        return;
    }

//Récupère les articles dans la base de données
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
$rqt=mysqli_query($link,"SELECT post.id, post.title, post.FK_adminuser, post.FK_category, category.name, date FROM post INNER JOIN category ON post.FK_category = category.id ") or die( mysqli_error($link));

?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Blog admin</title>

    <!-- Custom styles for this template -->
    <link href="blogadmin.css" rel="stylesheet">
  </head>

  <body>


    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Bison Factory</a>
      <input class="form-control form-control-dark w-50 d-none d-md-block" type="text" placeholder="Recherche" aria-label="Search">
      <div class="mx-auto">
        <em> <?php echo $welcome ?> </em>
      </div>
      <div class="mx-auto">
          <a class="nav-link" href="deconnexion.php">Déconnexion</a>
      </div>
    </nav>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap d-md-none">
        <button class="navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Tableau de bord <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../blog.php"  target="_blank">Voir le blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="categories.php">Catégories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="stats.php">Stats</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
            </form>
          </div>
      </li>
    </ul>
  </nav>



    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky" >
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
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
                <a class="nav-link" href="categories.php">
                  <span data-feather="file-text"></span>
                  Catégories
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="stats.php">
                  <span data-feather="bar-chart-2"></span>
                  Stats
                </a>
              </li>
            </ul>

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <br />



          <h2>Articles du blog</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Auteur</th>
                          <th>Titre</th>
                          <th>Catégorie</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <?php
                        for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
                            echo "<tr>
                                    <td><form action='suppress.php' method='post' onSubmit=\"return confirm('Les articles sélectionnés seront supprimés définitivement');\" ><input type='checkbox' name='suppr[]' value=".$post['id']." /></td>
                                    <td>".$post["FK_adminuser"]."</td>
                                    <td>".$post["title"]."</td>
                                    <td>".$post["name"]."</td>
                                    <td>".$post["date"]."</td>

                                    <td><a href='update.php?id=".$post['id']."'>Éditer</a></td>
                                </tr>";
                        }
                        echo"<tr><td><input class='btn btn-danger' id='envoi' type='submit' value='Supprimer' /></td></tr></form>"
                      ?>
              </table>

              <div>
                  <a href="redactor.php" class="btn btn-info my-5 float-right">Écrire un nouvel article</a>
              </div>
          </div>
        </main>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>
</html>
