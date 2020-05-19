<?php

session_start();
//Connexion base de données
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
//Vérification des droits de connexion
if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
  echo "Vous devez vous connecter.  <a href='login.php'> Connexion.</a>";
  exit;
}

//Récupère l'id de l'article à modifier depuis l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])) {
  $id=$_GET['id'];
  //Récupère le contenu de l'article à modifier selon son id
  $sql = mysqli_query($link,"SELECT * FROM post WHERE id='$id'");

  // parcourt les données sous forme de tableau
  $data =  mysqli_fetch_array($sql);
  }


  // AJOUT DE CATEGORIES
  if (isset($_POST["name"])) {
       $name=$_POST["name"];
      mysqli_query($link,"INSERT INTO category(name) VALUES ('$name');");
  }

  $rqt=mysqli_query($link,"SELECT * FROM category");

   if (isset($_POST["name"])){
       echo json_encode($categories);
       return;
   }


   //Enregistrement des modifications de l'article
   if (isset($_POST["title"]) && isset($_POST["post"])) {
     $title=$_POST['title'];
     $content=$_POST['post'];
     $category=$_POST['category'];
     //On prend le nom de l'auteur et pas la foreign key id finalement
     $authorId = $_SESSION['authUser'];
     $date=date("Y-m-d H:i:s");
     $id=$_GET['id'];
     //requête pour enregistrer les modifications de l'article dans la base de données
     mysqli_query($link,"UPDATE post SET id='$id', title ='$title', content='$content', FK_category='$category', FK_adminuser='$authorId', date='$date' WHERE id='$id';");
 }

?>


<!DOCTYPE html>
<html>
<head>
 <title>Edition</title>
 <meta charset="utf-8">
</head>
<body>
  <p> Vous êtes connecté en tant que <?php echo $_SESSION['authUser'] ?> </p>
  <a href='../blog.php'> Voir le blog</a>
  <br />
  <a href='admin.php'> Retour admin</a>
  <h1>Modifier l'article : </h1>
  <br/>
      <div>Choisissez la catégorie :</div>
      <div id='choixcategory'>
          <select id='listCategories'>
            <option value="" disabled>--Choisir une catégorie--</option>
              <?php
              for ($i=0;$categories=mysqli_fetch_assoc($rqt);$i++){
                echo "<option value='".$categories['id']."'>".$categories['name']."</option>";
              }
              ?>
          </select>
      </div>
      <div>
          Ajouter une nouvelle catégorie :
          <button id="addCategory">Créer une nouvelle catégorie</button>
     </div>
     <div>
       Titre de l'article :
     <input id="postTitle" type="text" name="article_titre" value="<?php echo $data['title'] ?>"/>
     </div>
     <br />
     <textarea name="content" placeholder="Contenu de l'article"> <?php echo $data['content'] ?></textarea><br />
     <button id="publish"> enregistrer </button>
   <br />


   <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <script>
        //remplace le textarea par l'éditeur de texte ckeditor 4
        CKEDITOR.replace('content');

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
              $('#choixcategory').load('http://blog/admin/update.php #listCategories');
         });


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
              "category" : $("#listCategories").val()
           },
           success: function(){
              window.location.href = "admin.php";
           }
       })
       }
       });
   </script>


  </body>
</html>
