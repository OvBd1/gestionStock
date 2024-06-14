<?php 
include 'connexion.php';

if (!empty($_POST['libelle_categorie'])) {
  $libelle_categorie = $_POST['libelle_categorie'];

  $sql = "INSERT INTO categorie_article(libelle_categorie) VALUES(?)";
  $req = $connexion->prepare($sql);
  $req->execute([$libelle_categorie]);

  if ($req->rowCount() != 0) {
    $_SESSION['message']['text'] = "Catégorie ajouté avec succès"; 
    $_SESSION['message']['type'] = "success"; 
  } else {
    $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout de la catégorie"; 
    $_SESSION['message']['type'] = "danger"; 
  }
} else {
  $_SESSION['message']['text'] = "Une information obligatoire non renseignée"; 
  $_SESSION['message']['type'] = "danger"; 
}

header('Location: ../vue/categorie.php');

