<?php
include 'connexion.php';
include_once 'functions.php';

if (
  !empty($_POST['id_article'])
  && !empty($_POST['id_client'])
  && !empty($_POST['quantite'])
  && !empty($_POST['prix'])
) {
  $id_article = $_POST['id_article'];
  $id_client = $_POST['id_client'];
  $quantite = $_POST['quantite'];
  $prix = $_POST['prix'];

  $article = getArticle($id_article);

  if (!empty($article) && is_array($article)) {
    if ($quantite > $article['quantite']) {
      $_SESSION['message']['text'] = "La quantité demandée est supérieure à la quantité disponible";
      $_SESSION['message']['type'] = "danger";
    } else {
      $sql = "INSERT INTO vente(id_article, id_client, quantite, prix) VALUES(?, ?, ?, ?)";
      $req = $connexion->prepare($sql);
      $req->execute([$id_article, $id_client, $quantite, $prix]);

      if ($req->rowCount() != 0) {
        $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$quantite, $id_article]);

        if ($req->rowCount() != 0) {
          $_SESSION['message']['text'] = "Vente effectué avec succès";
          $_SESSION['message']['type'] = "success";
        } else {
          $_SESSION['message']['text'] = "Impossible de faire cette vente";
          $_SESSION['message']['type'] = "danger";
        }
      } else {
        $_SESSION['message']['text'] = "Une erreur est survenue lors de la vente";
        $_SESSION['message']['type'] = "danger";
      }
    }
  }
} else {
  $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
  $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/vente.php');