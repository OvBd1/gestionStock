<?php 
include 'connexion.php';

function getArticle($id = null) {
 if (!empty($id)) {
  $sql = "SELECT * FROM article WHERE id = ?";
  $req = $GLOBALS['connexion']->prepare($sql);
  $req->execute([$id]);
  return $req->fetch();
 } else {
  $sql = "SELECT * FROM article";
  $req = $GLOBALS['connexion']->prepare($sql);
  $req->execute();
  return $req->fetchAll(); }
}

function getClient($id = null) {
  if (!empty($id)) {
   $sql = "SELECT * FROM client WHERE id = ?";
   $req = $GLOBALS['connexion']->prepare($sql);
   $req->execute([$id]);
   return $req->fetch();
  } else {
   $sql = "SELECT * FROM client";
   $req = $GLOBALS['connexion']->prepare($sql);
   $req->execute();
   return $req->fetchAll(); }
 }