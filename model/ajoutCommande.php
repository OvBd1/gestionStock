<?php
include 'connexion.php';
include_once 'function.php';

if (
  !empty($_POST['id_article'])
  && !empty($_POST['id_fournisseur'])
  && !empty($_POST['quantite'])
  && !empty($_POST['prix'])
) {
  $id_article = $_POST['id_article'];
  $id_fournisseur = $_POST['id_fournisseur'];
  $quantite = abs($_POST['quantite']);
  $prix = abs($_POST['prix']);

  $sql = "INSERT INTO commande(id_article, id_fournisseur, quantite, prix) VALUES(?, ?, ?, ?)";
  $req = $connexion->prepare($sql);
  $req->execute([$id_article, $id_fournisseur, $quantite, $prix]);

  if ($req->rowCount() != 0) {
    $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
    $req = $connexion->prepare($sql);
    $req->execute([$quantite, $id_article]);

    if ($req->rowCount() != 0) {
      $_SESSION['message']['text'] = "Commande effectué avec succès";
      $_SESSION['message']['type'] = "success";
    } else {
      $_SESSION['message']['text'] = "Impossible de faire cette commande";
      $_SESSION['message']['type'] = "danger";
    }
  } else {
    $_SESSION['message']['text'] = "Une erreur est survenue lors de la commande";
    $_SESSION['message']['type'] = "danger";
  }


} else {
  $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
  $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/commande.php');