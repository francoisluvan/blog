<?php

session_start();
//connexion base de données
$link = mysqli_connect("bisonfgadmin.mysql.db", "bisonfgadmin","Tarsi0701", "bisonfgadmin") or die ("Impossible de se connecter: ".mysql_error());
//Récupère les données des articles dans la base de données
$rqt=mysqli_query($link,"SELECT post.id, post.title, post.soustitre, post.description, post.FK_adminuser, category.name, post.content, post.duree, date, post.image FROM post INNER JOIN category ON post.FK_category = category.id ") or die( mysqli_error($link));





?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./style/bootstrap/bootstrap.min.css">
    <link href="./style/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./style/style.css">

  </head>
  <body id="page-top">

    <!-- Menu -->
    <nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg" id="mainNav">
      <a class="navbar-brand js-scroll-trigger" href="index.php">Bison Factory</a>
      <!-- Menu responsive -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> MENU
      <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto text-uppercase">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#a-propos">A propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#page-top">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="contact.html">Contact</a>
            </li>
          </ul>
        </div>
    </nav>


    <!-- Header -->
    <header class="masthead d-flex align-items-center" style="max-height:500px">
      <div class="container">
        <div class="intro-text">
          <div class="intro-heading text-uppercase">Blog</div>
          <div class="intro-lead-in">Les tendances de l'entreprenariat</div>
      </div>
    </header>





    <!-- Blog grid -->
    <section class="bg-light page-section" id="blog">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Les derniers articles</h2>
            <h3 class="section-subheading text-muted">Toutes les actualités du secteur.</h3>
          </div>
        </div>
        <div class="row">
  <?php
      for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
        echo
          '<div class="col-md-4 col-sm-6 blog-item my-4" style="height:80%">
            <a class="blog-link stretched-link" style="text-decoration:none" href="article.php?p='.$post["id"].'">
              <img class="img-fluid" src="'.$post['image'].'" alt="">
          <div class="mb-4">
            <div class="blog-caption mb-3">
              <h4 style="color:black" display: -webkit-box;max-height: 120px;-webkit-line-clamp: 4;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">'.utf8_encode($post["title"]).'</h4>
              <p class="text-muted my-2">'.utf8_encode($post["name"]).'</p>
              <p class="text-muted my-2"  style="color:grey;text-decoration:none;font-style:italic;display: -webkit-box;max-height: 120px;-webkit-line-clamp: 4;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">'.utf8_encode($post["description"]).'</p>
              </div>
            <div class="container col-12">
            <button id="readtime" class="btn btn-sm btn-dark ">'.$post["duree"].' min de lecture</button>
            </div>
            </div>
            </a>
          </div>';
        }
      ?>
      </div>
    </div>
    </section>



    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; François Lu Van 2020</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
              <a href='/admin/login.php' target="_blank"> se connecter</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

  <script src="./js/jquery.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./style/bootstrap/bootstrap.min.js"></script>
    <script src="./js/jquery.easing.min.js"></script>
  <script src="./js/monsite.min.js"></script>

  </body>
</html>
