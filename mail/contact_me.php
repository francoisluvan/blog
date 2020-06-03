<?php
// Vérifie si les champs sont remplis
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Champs non rempli";
   return false;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Récupère et met en forme l'email contenant les informations reçues dans le formulaire
$to = 'francois.luvan@gmail.com'; // adresse email de réception
$email_subject = "De:  $name";
$email_body = "Vous avez reçu un message depuis bison.factory.com.\n\n"."Voici le message :\n\nNom: $name\n\nEmail: $email_address\n\nTéléphone: $phone\n\nMessage:\n$message";
$headers = "email envoyé depuis: francois.luvan@gmail.com\n"; // adresse email depuis laquelle le mail est envoyé. Si possible utiliser une noreply
$headers .= "Répondre: $email_address";
mail($to,$email_subject,$email_body,$headers);
return true;
?>
