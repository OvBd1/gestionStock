<?php 
session_start();

$server = "localhost";
$base = "stock";
$user = "root";
$mdp = "";

try {
  $connexion = new PDO("mysql:host=$server;dbname=$base", $user, $mdp);
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $connexion;
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}