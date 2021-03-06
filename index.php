<?php
ini_set('display_errors',1);
session_start();
//connexion base de données
require ('./admin/config.php');
//Récupère les données des articles dans la base de données
$rqt=mysqli_query($link,"SELECT post.id, post.title, post.soustitre, post.description, post.FK_adminuser, category.name, post.content, post.duree, date, post.image FROM post INNER JOIN category ON post.FK_category = category.id WHERE post.visible = 'visible'") or die( mysqli_error($link));
$rqt2=mysqli_query($link,"SELECT post.id, post.title, post.soustitre, post.description, post.FK_adminuser, category.name, post.content, post.duree, date, post.image FROM post INNER JOIN category ON post.FK_category = category.id WHERE post.visible = 'visible'") or die( mysqli_error($link));
?>



<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168109459-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-168109459-1');
    </script>

    <title>BISON FACTORY</title>
    <meta name="description" content="Bison Factory accompagne les entrepreneurs dans la création d'entreprise. Conseil en comptabilité gestion, marketing communication et développement web. Bison Factory Conseil. Page d'accueil">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="https://bisonfactory.com/favicon.ico">
    <link rel="stylesheet" href="./style/bootstrap/bootstrap.min.css">
    <link href="./style/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" /><link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

  </head>
  <body id="page-top">

    <!-- Menu -->
    <nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg" id="mainNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img class="img-fluid" src="./images/logoblanc.png" alt="logo bison factory"></a>
      <!-- Menu responsive -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> MENU
      <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto text-uppercase">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#a-propos">A propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#blog">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
    </nav>


    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <h1 class="intro-heading text-uppercase text-left">Lancez-vous.</h1>
          <div class="intro-heading text-uppercase text-left">Devenez entrepreneur.</div>
          <a class="btn btn-dark btn-xl text-uppercase js-scroll-trigger" href="#services">En savoir plus</a>
        </div>
        <hr>
      </div>
    </header>

    <!-- Services -->
    <section class="page-section" id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Les services proposés par Bison Factory</h2>
            <h3 class="section-subheading text-muted">Un accompagnement à votre mesure.</h3>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-dark"></i>
              <i class="fas fa-chart-line fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Comptabilité Gestion</h4>
            <p class="text-muted">Les chiffres ne sont pas votre fort ? Pas de panique, Bison Factory vous accompagnons dans la gestion comptable de votre entreprise.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-dark"></i>
              <i class="fas fa-bullhorn fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Marketing Communication</h4>
            <p class="text-muted">Définissons ensemble une stratégie pour attirer toujours plus de clients !</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-dark"></i>
              <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Développement web</h4>
            <p class="text-muted">Un indispensable ! Le site internet de votre entreprise doit refléter vos valeurs. Nous vous aidons à assurer votre présence en ligne. </p>
          </div>
        </div>
      </div>
      <div class="container text-center text-dark mt-5">
        <a class="btn btn-sm btn-dark" href="services"> Plus d'infos </a>
      </div>
    </section>

    <!-- A propos -->
    <section class="bg-dark page-section" id="a-propos">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center section-img">
            <h2 class="section-heading text-uppercase text-muted before" style="color:white !important">A Propos</h2>
            <h3 class="section-subheading text-muted before" style="color:white !important">Qui sommes-nous ?</h3>
            <h4 class="section-subheading text-muted before" style="color:white !important"> <i> "Dans les affaires, Les grandes choses ne sont jamais faites par une seule personne, elles sont faites par toute une équipe." - Steve Jobs </i> </h4>
            <p class="section-subheading text-muted before" style="color:white !important">  Bison Factory accompagne les entrepreneurs dans les premiers pas de leur création d'entreprise. Vous avez une idée ou un projet ? Nous vous aidons à définir la meilleure stratégie. Avec Bison Factory, franchissez les étapes vers le succès ! </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog grid -->
    <!-- Carousel -->

  <section class="bg-light page-section" id="blog">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">blog</h2>
          <h3 class="section-subheading text-muted">Les derniers articles par nos experts sont en ligne sur le blog de Bison Factory.</h3>
        </div>
      </div>


    <div class="container text-center my-3">
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                <div class="carousel-item active">
                  <?php
                      for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
                        echo '

                      <div class="col-md-4 col-sm-12 blog-item my-4" style="height:80%; min-width:300px">
                        <a class="blog-link stretched-link" style="text-decoration:none" href="article?p='.$post["id"].'">
                        <div class="img-fluid" style="background: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ), url('.$post["image"].');  background-repeat: no-repeat;
                          background-attachment: scroll;
                          background-position: center ;
                          background-size: cover; max-height:120px;">
                        </div>
                      <div class="mb-4">
                        <div class="blog-caption mb-3">
                          <h4 style="color:black">'.utf8_encode($post["title"]).'</h4>
                          <p class="text-muted">'.utf8_encode($post["name"]).'</p>
                          <p class="text-muted my-2"  style="color:grey;text-decoration:none;font-style:italic;display: -webkit-box;max-height: 120px;-webkit-line-clamp: 4;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">'.utf8_encode($post["description"]).'</p>
                          </div>
                        <div class="container col-12">
                        <button id="readtime" class="btn btn-sm btn-dark ">'.$post["duree"].' min de lecture</button>
                        </div>
                        </div>
                        </a>
                      </div>


                ';
                    }
                  ?>
              </div>
                  <?php
                      for ($i=0;$post2 = mysqli_fetch_array($rqt2);$i++) {
                        if ($i > 0) {
                        echo '
                    <div class="carousel-item">
                      <div class="col-md-4 col-sm-12 blog-item my-4" style="height:80%;min-width:300px">
                        <a class="blog-link stretched-link" style="text-decoration:none" href="article?p='.$post2["id"].'">
                          <div class="img-fluid" style="background: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ), url('.$post2["image"].');  background-repeat: no-repeat;
                            background-attachment: scroll;
                            background-position: center ;
                            background-size: cover; max-height:120px;">
                          </div>
                      <div class="mb-4">
                        <div class="blog-caption mb-3">
                          <h4 style="color:black">'.utf8_encode($post2["title"]).'</h4>
                          <p class="text-muted">'.utf8_encode($post2["name"]).'</p>
                            <p class="text-muted my-2"  style="color:grey;text-decoration:none;font-style:italic;display: -webkit-box;max-height: 100px;-webkit-line-clamp: 4;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">'.utf8_encode($post2["description"]).'</p>
                          </div>
                        <div class="container col-12">
                        <button id="readtime" class="btn btn-sm btn-dark ">3 min de lecture</button>
                        </div>
                        </div>
                        </a>
                      </div>

                </div>
                ';
              }}
                ?>
                </div>

                <a id="caroubutton1" class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a id="caroubutton2" class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>

      </div>

    </div>



      <div class="container text-center text-dark mt-5">
        <a class="btn btn-sm btn-dark" href="blog"> Tous les articles </a>
      </div>
    </section>

    <!-- Avis clients -->
    <section class="page-section" id="avis-clients">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Ils nous font confiance</h2>
            <h3 class="section-subheading text-muted">Retours des clients accompagnés par Bison Factory.</h3>
            <img class="img-fluid" src="https://bisonfactory.com/images/uploads/avis-clients-site-internet-1-1.jpg" alt="Bison Factory avis client">
          </div>
        </div>
      </div>
    </section>

    <!-- Contact -->
    <section class="page-section" id="contact">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="section-heading text-uppercase text-center">Contactez-nous</h2>
            <h3 class="section-subheading text-muted text-light text-center">Trouvons ensemble l'accompagnement qui vous correspond.</h3>
            <a id="contact-button" class="btn btn-dark btn-xl text-uppercase" href="contact">Prendre contact</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row align-items-center">
          <div id="logodiv" class="col-md-4">
            <a href="#">
            <img class="img-fluid mb-3" src="./images/logobisonfactory.png" alt="logo bison factory">
            </a>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="https://twitter.com/FactoryBison" target="_blank">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.facebook.com/Bison-Factory-113583067056257" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.linkedin.com/company/54290265" target="_blank">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
              <a href='/admin/login' target="_blank"> se connecter</a>
              </li>
              <li class="list-inline-item">
                <a href="mentions-legales">Mentions légales</a>
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
  <script src="./js/animation.js"></script>

  </body>
</html>
