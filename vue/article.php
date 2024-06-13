<?php 
include '../partials/header.php';

if (!empty($_GET['id'])) {
  $article = getArticle($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post">
        <label for="nom_article">Nom de l'article</label>
        <input value="<?= !empty($_GET['id']) ? $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Nom de l'article">

        <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="categorie">Catégorie</label>
        <select name="categorie" id="categorie">
          <option <?= !empty($_GET['id']) && $article["categorie"] == "Ordinateur" ? "selected" : "" ?> value="Ordinateur">Ordinateur</option>
          <option <?= !empty($_GET['id']) && $article["categorie"] == "Imprimante" ? "selected" : "" ?> value="Imprimante">Imprimante</option>
          <option <?= !empty($_GET['id']) && $article["categorie"] == "Accessoire" ? "selected" : "" ?> value="Accessoire">Accessoire</option>
        </select>

        <label for="quantite">Quantité</label>
        <input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Quantité">

        <label for="prix_unitaire">Prix unitaire</label>
        <input value="<?= !empty($_GET['id']) ? $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Prix">

        <label for="date_fabrication">Date de fabrication</label>
        <input value="<?= !empty($_GET['id']) ? $article['date_fabrication'] : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

        <label for="date_expiration">Date d'expiration</label>
        <input value="<?= !empty($_GET['id']) ? $article['date_expiration'] : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">

        <button type="submit">Valider</button>

        <?php
        if (!empty($_SESSION['message']['text'])) {
          ?>
          <div class="alert <?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
          </div>
        <?php
        }
        $_SESSION['message']['text'] = "";
        $_SESSION['message']['type'] = "";
        ?>

      </form>
    </div>
    <div class="box table-responsive">
      <table class="mtable">
        <tr>
          <th>Nom de l'article</th>
          <th>Catégorie</th>
          <th>Quantité</th>
          <th>Prix unitaire</th>
          <th>Date de fabrication</th>
          <th>Date d'expiration</th>
          <th>Action</th>
        </tr>
        <?php
        $articles = getArticle();

        if (!empty($articles) && is_array($articles)) {
          foreach ($articles as $article) {
            ?>
            <tr>
              <td><?= $article['nom_article'] ?></td>
              <td><?= $article['categorie'] ?></td>
              <td><?= $article['quantite'] ?></td>
              <td><?= $article['prix_unitaire'] ?> €</td>
              <td><?= date('d/m/Y', strtotime($article['date_fabrication'])) ?></td>
              <td><?= date('d/m/Y', strtotime($article['date_expiration'])) ?></td>
              <td><a href="?id=<?= $article['id']?>"><i class='bx bx-edit-alt'></i></a></td>
            </tr>
            <?php
          }
        }
        ?>
      </table>
    </div>
  </div>

</div>

<?php 
include '../partials/footer.php';
?>