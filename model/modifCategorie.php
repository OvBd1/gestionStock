<?php 
include 'connexion.php';

if (
  !empty($_POST['libelle_categorie'])
  && !empty($_POST['id'])
) {
  $libelle_categorie = $_POST['libelle_categorie'];
  $id = $_POST['id'];

  $sql = "UPDATE categorie_article SET libelle_categorie = ? WHERE id = ?";
  $req = $connexion->prepare($sql);
  $req->execute([$libelle_categorie, $id]);

  if ($req->rowCount() != 0) {
    $_SESSION['message']['text'] = "Catégorie modifié avec succès"; 
    $_SESSION['message']['type'] = "success"; 
  } else {
    $_SESSION['message']['text'] = "Rien a été modifié"; 
    $_SESSION['message']['type'] = "warning"; 
  }
} else {
  $_SESSION['message']['text'] = "Une information obligatoire non renseignée"; 
  $_SESSION['message']['type'] = "danger"; 
  return $_POST;  
}

header('Location: ../vue/categorie.php');