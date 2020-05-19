<?php

session_start();
//connexion base de données
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
//Récupère les données des articles dans la base de données
$rqt=mysqli_query($link,"SELECT post.id, post.title, post.FK_adminuser, category.name, post.content, date FROM post INNER JOIN category ON post.FK_category = category.id ") or die( mysqli_error($link));

?>


<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  <a href='/admin/admin.php'> se connecter</a>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
                      echo
                      "<div class='wrap-post'>
                          <div class='header-post'>
                              <div class='title-post'>".$post["title"]."
                                  <div class='info-post'>".$post["name"].", par ".$post["FK_adminuser"]." le ".$post["date"]."</div>
                              </div>
                          </div>
                          <div class='content-post'>
                              <div class='content'>".$post["content"]."</div>
                              <div class='fade-content'><a href='article.php?p=".$post["id"]."'>Lire la suite</a></div>
                              <br />
                              <br />
                         </div>
                      </div>";
                    }
                  ?>
              </div>
          </div>
      </div>
  </body>
</html>
