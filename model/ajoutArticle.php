<?php 
include 'connexion.php';

if (
  !empty($_POST['nom_article'])
  && !empty($_POST['id_categorie'])
  && !empty($_POST['quantite'])
  && !empty($_POST['prix_unitaire'])
  && !empty($_POST['date_fabrication'])
  && !empty($_POST['date_expiration'])
  && !empty($_FILES['images'])
) {
  $nom_article = $_POST['nom_article'];
  $id_categorie = $_POST['id_categorie'];
  $quantite = abs($_POST['quantite']);
  $prix_unitaire = abs($_POST['prix_unitaire']);
  $date_fabrication = $_POST['date_fabrication'];
  $date_expiration = $_POST['date_expiration'];

  $sql = "INSERT INTO article(nom_article, id_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, images) VALUES(?, ?, ?, ?, ?, ?, ?)";
  $req = $connexion->prepare($sql);

  $name = $_FILES['images']['name'];
  $tmp_name = $_FILES['images']['tmp_name'];
  $folder = "../public/img/";
  $destination = "../public/img/$name";

  if (is_dir($folder)) {
    mkdir($folder, 0777, true);
  }

  if (move_uploaded_file($tmp_name, $destination)) {
    $req->execute([$nom_article, $id_categorie, $quantite, $prix_unitaire, $date_fabrication, $date_expiration, $destination]);

    if ($req->rowCount() != 0) {
      $_SESSION['message']['text'] = "Article ajouté avec succès"; 
      $_SESSION['message']['type'] = "success"; 
    } else {
      $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout de l'article"; 
      $_SESSION['message']['type'] = "danger"; 
    }
  } else {
    $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout de l'image"; 
    $_SESSION['message']['type'] = "danger";
  }

} else {
  $_SESSION['message']['text'] = "Une information obligatoire non renseignée"; 
  $_SESSION['message']['type'] = "danger"; 
}

header('Location: ../vue/article.php');