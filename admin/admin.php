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
require ('config.php');
$rqt=mysqli_query($link,"SELECT post.id, post.title, post.soustitre, post.description, post.FK_adminuser, post.FK_category, category.name, post.duree, date, post.image, post.visible FROM post INNER JOIN category ON post.FK_category = category.id ") or die( mysqli_error($link));


?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">



    <title>Blog admin</title>

    <!-- Custom styles for this template -->
    <link href="../style/blogadmin.css" rel="stylesheet">
  </head>

  <body>

    <!-- Menu -->
    <div class="sticky-top">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index" target="_blank">Bison Factory</a>
      <div class="mx-5 row col-9 d-flex align-items-center">
        <em class="text-left col-6"> <?php echo $welcome ?> </em>
          <a class="nav-link deconnect col-6 text-right" href="deconnexion.php">Déconnexion</a>
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
          </div>
      </li>
    </ul>
  </nav>
</div>


    <!-- Menu latéral -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-flex d-md-block bg-light sidebar mt-5">
          <div class="sidebar-sticky mt-3 " >
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
          <div>
              <a href="redactor.php" class="btn btn-info float-right ">Écrire un nouvel article</a>
          </div>
          <br />

          <!-- Tableau -->
          <h2 class=>Articles du blog</h2>
          <div class="table-responsive mt-4">
            <table id="table_id" class="table display table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Auteur</th>
                          <th>Titre</th>
                          <th>Sous-titre</th>
                          <th>Description</th>
                          <th>Catégorie</th>
                          <th>Durée de lecture</th>
                          <th>Date</th>
                          <th>Image de couverture</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <?php
                        for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
                            echo "<tr>
                                    <td>".$post["FK_adminuser"]."</td>
                                    <td><div' style='font-style:italic;display:block; max-width: 100px; overflow: wrap;'>".utf8_encode($post["title"])."</div></td>
                                    <td><p style='font-style:italic;display:block;width:180px; max-width: 200px;overflow: wrap;'>".utf8_encode($post["soustitre"])."</p></td>
                                    <td><p style='font-style:italic;display:block;width:180px; max-width: 200px;overflow:wrap;'>".utf8_encode($post["description"])."</p></td>
                                    <td>".utf8_encode($post["name"])."</td>
                                    <td>".$post["duree"]." min </td>
                                    <td>".$post["date"]."</td>

                                    <td style='display:block;max-width: 300px; width:200px;'>
                                      <form action='upload.php' method='post' enctype='multipart/form-data' style='max-width:300px; width:280px;'>


                                          <input type='hidden' name='articleid' value=".$post['id']."/>
                                            <div id='saveimage".$post['id']."' class='savediv'>
                                              <label id='".$post['id']."' for='fileToUpload".$post['id']."' class='label-file btn btn-sm btn-dark'>
                                                choisir image
                                              </label>
                                                <input type='file' class='input-file' name='fileToUpload' id='fileToUpload".$post['id']."' style='display:none'/>
                                                  <div id='divfileToUpload".$post['id']."' class='filename'>
                                                  </div>
                                            </div>
                                          <p class='currentimg' style='color:green; font-style:italic;display:block;max-width: 200px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;'> Image actuelle : ".$post['image']." </p>
                                      </form>
                                    </td>
                                    <td><a class='btn btn-sm btn-primary text-light' href='visible.php?id=".$post['id']."&status=".$post["visible"]."' value='".$post["visible"]."''>".$post["visible"]."</a></td>
                                    <td><a class='btn btn-sm btn-warning text-light' href='update.php?id=".$post['id']."'>Éditer</a></td>
                                    <td><form action='suppress.php' method='post'  onSubmit=\"return confirm('Cet article sera supprimé définitivement');\" >
                                    <input type='hidden' name='suppr' value=".$post['id']."/>
                                    <td><input class='btn btn-sm btn-danger' type='submit' value='Supprimer' /></td></form>
                                    <td><a target='_blank' href='https://bisonfactory.com/article.php?p=".$post['id']."'>Voir article</a></td>
                                </tr>";
                        }
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>  $(document).ready(function() {
    $('#table_id').DataTable( {
          "language": {
    "decimal":        "",
    "emptyTable":     "Aucune donnée",
    "info":           "Articles _START_ à _END_ sur un total de _TOTAL_ article(s)",
    "infoEmpty":      "aucun résultat",
    "infoFiltered":   "(_MAX_ résultat(s filtré(s)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher _MENU_ articles",
    "loadingRecords": "chargement...",
    "processing":     "chargement...",
    "search":         "rechercher:",
    "zeroRecords":    "Aucun résultat",
    "paginate": {
        "first":      "Premier",
        "last":       "Dernier",
        "next":       "suivant",
        "previous":   "précédent"
    },
    "aria": {
        "sortAscending":  ": ranger par ordre croissant",
        "sortDescending": ": ranger par ordre décroissant"
    }
}
        }
     );
});
    </script>


    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      //icones menu
      feather.replace()

      //afficher nom fichier upload image


      $('input[type="file"]').change(function(e) {
        var id = this.id;
                      var nameimage = e.target.files[0].name;
                      $('#div'+id).append('<p class="msgimg" style="color:red"> Voulez-vous enregistrer la nouvelle image ? ('+nameimage+')');
                    });


      //afficher bouton enregistrer image
      $('.label-file').one('click', function(){
        var id = this.id;
        var savebtn = "<input  class='save btn btn-sm btn-success' type='submit' value='Enregistrer' name='submit'/>";
        var cancelbtn = "<input id='Upload"+id+"' class='cancel btn btn-sm btn-danger' value='annuler' type='button'/>";
        $('#divfileToUpload'+id).append("<div class='buttons'>"+savebtn + " "+ cancelbtn + "</div>");

      });

      //annuler upload image
      $(".filename").on('click', '.cancel', function(){
        var id = this.id;
        $("#divfileTo"+id).hide();
        $(".msgimg").remove();
      });


      $(".savediv").on('click', '.label-file', function(){
          var id = this.id;
        $("#divfileToUpload"+id).show();
      });



    </script>

  </body>
</html>
