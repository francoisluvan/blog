<?php

session_start();
//Récupère l'id de l'article dans l'url
if(isset($_GET['p'])){
  $id=$_GET['p'];
}
else
{
  echo "article introuvable";
  exit;
}

//connexion base de données
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
//Récupère le contenu de l'article sélectionné
$rqt=mysqli_query($link,"SELECT post.id, post.title, post.FK_adminuser, category.name, post.content, date, post.image FROM post INNER JOIN category ON post.FK_category = category.id WHERE post.id = '$id'") or die( mysqli_error($link));


?>




    <!DOCTYPE html>
    <html lang="fr" dir="ltr">
      <head>
        <meta charset="utf-8">

        <title>Article</title>

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
    <?php
      for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
            echo
        '<header class="masthead" style="max-height:500px;background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ),  url('.$post["image"].');  background-repeat: no-repeat;
          background-attachment: scroll;
          background-position: center ;
          background-size: cover;">
          <div class="container">
            <div class="intro-text">
              <div class="intro-heading text-uppercase">
                  '.$post["title"].'
              <div class="intro-lead-in">Sous-titre</div>
          </div>
        </header>





        <section class="bg-light page-section" style="padding-top:3em">
          <div class="container">
            <div class="row">
              <div class="header-post">
                  <div class="fade-content"><a href="blog.php">Retour aux articles</a></div>
                  <div> publié dans la rubrique '.$post["name"].', par '.$post["FK_adminuser"].' le '.$post["date"].'</div>
              </div>
            </div>
            <div class="row d-flex justify-content-center mx-5">
                <div class=" my-5">
                            <div class="content-post">
                                <div class="content">'.$post["content"].'</div>
                                <div class="fade-content"><a href="blog.php">Retour aux articles</a></div>
                           </div>
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
                  <a href='/admin/login.php'> se connecter</a>
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
