

<?php

    session_start();
    $welcome = "Bienvenue " . $_SESSION['authUser'];

    if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
      echo "Veuillez vous connecter.  <a href='login.php'> Connexion</a>";
      exit;
    }

    // CONNEXION BASE DE DONNEES
    $link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

    // AJOUT DE CATEGORIES
    if (isset($_POST["name"])) {
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        mysqli_query($link,"INSERT INTO category(name) VALUES ('$name');");
    }

    $rqt=mysqli_query($link,"SELECT * FROM category");

     if (isset($_POST["name"])){
         echo json_encode($categories);
         return;
     }


     //AJOUT D'UN ARTICLE
     if (isset($_POST["title"]) && isset($_POST["post"])) {
       $title = mysqli_real_escape_string($link,$_POST['title']);
       $content = mysqli_real_escape_string($link,$_POST['post']);
       $category = intval($_POST['category']);
       $authorId = mysqli_real_escape_string($link,$_SESSION['authUser']);
       $date = date("Y-m-d H:i:s");

       //Pour donner un id à l'article, on compte le nombre de lignes du tableau contenant les articles et on ajoute 1
       $rqt=mysqli_query($link,"SELECT COUNT(*) FROM post");
       $row = mysqli_fetch_array($rqt);
       $id=$row[0]+1;
       //Requête d'ajout de l'article dans la base de données
       mysqli_query($link,"INSERT INTO post(id, title, content, FK_category, FK_adminuser, date) VALUES ('$id','$title', '$content', '$category', '$authorId', '$date');");
   }


?>





<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Ecrire un article</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

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
              <li class="nav-item">
                <a class="nav-link" href="admin.php">Tableau de bord <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../blog.php" target="_blank">Voir le blog</a>
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



    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky" >
            <ul class="nav flex-column">
              <li class="nav-item mt-3">
                <a class="nav-link" href="admin.php">
                  <span data-feather="home"></span>
                  Tableau de bord <span class="sr-only"></span>
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



          <h2>Écrire un article</h2>
          <div>
              <div>
                  <div>
                      <h4>  Titre : </h4>
                  </div>
                    <input type='text' id="postTitle" ></input>
                  <div id="choixcategory" class="my-3">
                    <select id='listCategories' class="btn-sm bg-dark text-light">
                      <option value='0' disabled selected>--Choisir une catégorie--</option>
                        <?php
                        for ($i=0;$categories=mysqli_fetch_assoc($rqt);$i++){
                          echo "<option value='".$categories['id']."'>".$categories['name']."</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div >
                        <button id="addCategory" class="btn btn-dark btn-sm mb-3">Créer une nouvelle catégorie</button>
                    </div>
            <div><textarea id='content' name='content' style='display:none'></textarea></div>
          </div>
          <div>
          <button id="publish" class="btn btn-sm bg-dark text-light mt-3 mb-5">Publier</button>
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
    <!-- JS ajout de catégorie, publication d'article et warning dynamiques -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>

    //Remplace le textarea par l'éditeur de texte ckeditor 4


    CKEDITOR.replace( 'content');

    CKEDITOR.config.height= 400;
    CKEDITOR.config.width= 900;
        // AJOUT DE CATEGORIES
        $('#addCategory').on('click', function(){
          var newName = prompt("Entrez le nom de votre catégorie :");
          $.ajax({
                    method: "POST",
                    data: {
                        "name": newName
                    },
                    dataType: "json",
                    success:
                    function(categories){
                    var categoriesHtml;
                    for (category of categories){
                         categoriesHtml += "<option value='" + category['id'] + "' selected>" + category['name'] +  "</option>";
                    }
                      $('#listCategories').html(categoriesHtml);

                    }
                  });
                  //Recharge uniquement le menu déroulant des catégories pour ajouter la catégorie sans refresh la page
                  $('#choixcategory').load('http://blog/admin/redactor.php #listCategories');
            });


            // PUBLICATION DE L'ARTICLE
            $('#publish').on('click', function(){
              if($('#postTitle').val() == '' || $("#listCategories option:selected").val() == 0){
                alert("Renseignez le titre et choisissez une catégorie")
              }
              else{
                $.ajax({
                    method: "POST",
                    data: {
                      "post": CKEDITOR.instances.content.getData(),
                      "title": $("#postTitle").val(),
                       "category" : $("#listCategories").val()
                    },
                    success: function(){
                       window.location.href = "admin.php";
                    }
                })
              }

            });


            //Fonction warning si on quitte la page sans sauvegarder
            var unsaved = true;

            function showWindow(){
                if(unsaved){
                    return "Voulez-vous vraiment quitter cette page? Les modifications non sauvegardées seront perdues";
                }
            }

            $('#publish').click(function(){
                unsaved = null;
            });

            window.onbeforeunload = showWindow;


    </script>

  </body>
</html>
