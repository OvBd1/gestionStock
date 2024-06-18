<?php 
include 'connexion.php';

if (
  !empty($_POST['nom_article'])
  && !empty($_POST['id_categorie'])
  && !empty($_POST['quantite'])
  && !empty($_POST['prix_unitaire'])
  && !empty($_POST['date_fabrication'])
  && !empty($_POST['date_expiration'])
  && !empty($_POST['id'])
) {
  $nom_article = $_POST['nom_article'];
  $id_categorie = $_POST['id_categorie'];
  $quantite = abs($_POST['quantite']);
  $prix_unitaire = abs($_POST['prix_unitaire']);
  $date_fabrication = $_POST['date_fabrication'];
  $date_expiration = $_POST['date_expiration'];
  $id = $_POST['id'];

  $sql = "UPDATE article SET nom_article = ?, id_categorie = ?, quantite = ?, prix_unitaire = ?, date_fabrication = ?, date_expiration = ? WHERE id = ?";
  $req = $connexion->prepare($sql);
  $req->execute([$nom_article, $id_categorie, $quantite, $prix_unitaire, $date_fabrication, $date_expiration, $id]);

  if ($req->rowCount() != 0) {
    $_SESSION['message']['text'] = "Article modifié avec succès"; 
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

header('Location: ../vue/article.php');