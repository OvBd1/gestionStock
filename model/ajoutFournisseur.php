<?php 
include 'connexion.php';

if (
  !empty($_POST['nom'])
  && !empty($_POST['prenom'])
  && !empty($_POST['telephone'])
  && !empty($_POST['adresse'])
) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $telephone = $_POST['telephone'];
  $adresse = $_POST['adresse'];

  $sql = "INSERT INTO fournisseur(nom, prenom, telephone, adresse) VALUES(?, ?, ?, ?)";
  $req = $connexion->prepare($sql);
  $req->execute([$nom, $prenom, $telephone, $adresse]);

  if ($req->rowCount() != 0) {
    $_SESSION['message']['text'] = "Fournisseur ajouté avec succès"; 
    $_SESSION['message']['type'] = "success"; 
  } else {
    $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout du fournisseur"; 
    $_SESSION['message']['type'] = "danger"; 
  }
} else {
  $_SESSION['message']['text'] = "Une information obligatoire non renseignée"; 
  $_SESSION['message']['type'] = "danger"; 
}

header('Location: ../vue/fournisseur.php');