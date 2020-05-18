<?php
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

    session_start();

if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
  echo "Unauthorized Access.  <a href='login.php'> Connectez-vous.</a>";
  exit;
}

	if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $id=$_GET['id'];
    $sql = mysqli_query($link,"SELECT * FROM post WHERE id='$id'");

    // output data of each row
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


     //Modif d'un article
     if (isset($_POST["title"]) && isset($_POST["post"])) {
       $title=$_POST['title'];
       $content=$_POST['post'];
       $category=$_POST['category'];
       //On prend le nom de l'auteur et pas la foreign key id finalement
       $authorId = $_SESSION['authUser'];
       $date=date("Y-m-d H:i:s");
       $id=$_GET['id'];

       mysqli_query($link,"UPDATE post SET id='$id', title ='$title', content='$content', FK_category='$category', FK_adminuser='$authorId', date='$date' WHERE id='$id';");
   }

?>


<!DOCTYPE html>
<html>
<head>
 <title>Edition</title>
 <meta charset="utf-8">
 <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
</head>
<body>
    <p> Vous êtes connecté en tant que <?php echo $_SESSION['authUser'] ?> </p>
  <a href='../blog.php'> Voir le blog</a>
  <br />
  <a href='admin.php'> Retour admin</a>
  <h1>Modifier l'article : </h1>
  <br/>
          <div>Choisissez la catégorie :</div>
          <div>
              <select id='listCategories'>
                <option value="" disabled selected>--Choisir une catégorie--</option>
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
            <input id="postTitle" type="text" name="article_titre" placeholder="<?php echo $data['title'] ?>"/><br />
            <textarea id="editor" name="content" placeholder="Contenu de l'article"> <?php echo $data['content'] ?></textarea><br />
            <button id="publish"> enregistrer </button>
   <br />
  </body>
</html>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( content => {
        article = content; // Save for later use.
    } )
    .catch( error => {
        console.error( error );
    } );


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
              window.location.reload();
        });


    $('#publish').on('click', function(){
    $.ajax({
        method: "POST",
        data: {
          "post": article.getData(),
          "title": $("#postTitle").val(),
           "category" : $("#listCategories").val()
        },
        success: function(){
           window.location.href = "admin.php";
        }
    })
    });
</script>
