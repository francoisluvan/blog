<?php

session_start();
$welcome = "Bienvenue " . $_SESSION['authUser'];
//Connexion base de données
require ('config.php');
mysqli_set_charset($link,"utf8");
//Vérification des droits de connexion
if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
  echo "Vous devez vous connecter.  <a href='login.php'> Connexion.</a>";
  exit;
}

//Récupère l'id de l'article à modifier depuis l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])) {
  $id = intval($_GET['id']);
  //Récupère le contenu de l'article à modifier selon son id
  $sql = mysqli_query($link,"SELECT * FROM post WHERE id='$id'");
  //Récupère le nom de la catégorie de l'article sélectionné
  $requete = mysqli_query($link,"SELECT * FROM category INNER JOIN post ON post.FK_category = category.id WHERE post.id='$id'");

  // parcourt les données sous forme de tableau
  $data =  mysqli_fetch_array($sql);
  $result =  mysqli_fetch_array($requete);
  }



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


   //Enregistrement des modifications de l'article
   if (isset($_POST["title"]) && isset($_POST["post"])) {
     $title = mysqli_real_escape_string($link,$_POST['title']);
     $content = mysqli_real_escape_string($link,$_POST['post']);
     $soustitre = mysqli_real_escape_string($link,$_POST['soustitre']);
     $description = mysqli_real_escape_string($link,$_POST['description']);
     $category = intval($_POST['category']);
     $duree = intval($_POST['duree']);
     $authorId = mysqli_real_escape_string($link,$_SESSION['authUser']);
     $date=date("Y-m-d H:i:s");
     $id=intval($_GET['id']);
     //requête pour enregistrer les modifications de l'article dans la base de données
     mysqli_query($link,"UPDATE post SET id='$id', title ='$title', soustitre='$soustitre', description='$description', content='$content', FK_category='$category', FK_adminuser='$authorId', duree='$duree', date='$date' WHERE id='$id';");
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



          <h2>Éditer un article</h2>
          <div>
              <div>
                  <div>
                      <h4>  Titre : </h4>
                      <input id="postTitle" type="text" name="article_titre" style="width: 50%;" value="<?php echo $data['title'] ?>" maxlength="80"/>
                      <p><em> 80 caractères max </em></p>
                  </div>
                  <div>
                    <h5>  Sous-titre : </h5>
                    <textarea id='soustitre' style="width: 50%;"  maxlength="255"><?php echo $data['soustitre'] ?></textarea>
                    <p><em> 255 caractères max </em></p>
                  </div>
                  <div id="choixcategory" class="my-3">
                    <select id='listCategories' class="btn-sm bg-dark text-light ">
                      <option value='0' disabled selected>--Choisir une catégorie--</option>
                      <?php
                      echo "<option value='".$data['FK_category']."' selected style='display: none'>".$result['name']."</option>";
                      for ($i=0;$categories=mysqli_fetch_assoc($rqt);$i++){
                        echo "<option value='".$categories['id']."'>".$categories['name']."</option>";
                      }
                        ?>
                    </select>
              </div>
              <div>
                  <button id="addCategory" class="btn btn-dark btn-sm mb-3">Créer une nouvelle catégorie</button>
              </div>
              <div class='my-2'>
                Durée de lecture :
                <input id='duree' type='number' min="1" max="5" style="width: 4em;"  value="<?php echo $data['duree'] ?>"/>
                min
              </div>
              <div class='my-3'>
                <h5>  Description : </h5>
                <textarea id='description' style="width: 50%;"  maxlength="255"><?php echo $data['description'] ?></textarea>
                <p><em> 255 caractères max </em></p>
              </div>
              <div>
                <h5>  Contenu de l'article : </h5>
                <textarea name="content" placeholder="Contenu de l'article"> <?php echo $data['content'] ?></textarea><br /> </div>
          </div>
          <div>
          <button id="publish"  class="btn btn-sm bg-dark text-light mt-3 mb-5"> enregistrer </button>
          </div>
        </main>
      </div>
    </div>






    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

    CKEDITOR.config.height= 500;
    CKEDITOR.config.width= 'auto';
        // AJOUT DE CATEGORIES
        $('#addCategory').on('click', function(){
          var newName = prompt("Entrez le nom de votre catégorie :");
          if(newName != null){
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
                  $('#choixcategory').load('https://bisonfactory.com/admin/redactor.php #listCategories');
            }});


            // PUBLICATION DE L'ARTICLE MODIFIÉ
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
                 "soustitre" : $("#soustitre").val(),
                 "description" : $("#description").val(),
                  "category" : $("#listCategories").val(),
                  "duree" : $("#duree").val()
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
