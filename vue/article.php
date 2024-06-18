<?php
include '../partials/header.php';

if (!empty($_GET['id'])) {
  $article = getArticle($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post" enctype="multipart/form-data">
        <label for="nom_article">Nom de l'article</label>
        <input value="<?= !empty($_GET['id']) ? $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Nom de l'article">

        <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="id_categorie">Catégorie</label>
        <select name="id_categorie" id="id_categorie">
          <option value="">--Choisir une catégorie--</option>
          <?php
          $categories = getCategorie();

          if (!empty($categories) && is_array($categories)) {
            foreach ($categories as $categorie) {
              ?>
              <option <?= !empty($_GET['id']) && $article['id_categorie'] == $categorie['id'] ? "selected" : "" ?> value="<?= $categorie['id'] ?>"><?= $categorie['libelle_categorie'] ?></option>
              <?php
            }
          }
          ?>
        </select>

        <label for="quantite">Quantité</label>
        <input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Quantité">

        <label for="prix_unitaire">Prix unitaire</label>
        <input value="<?= !empty($_GET['id']) ? $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Prix">

        <label for="date_fabrication">Date de fabrication</label>
        <input value="<?= !empty($_GET['id']) ? $article['date_fabrication'] : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

        <label for="date_expiration">Date d'expiration</label>
        <input value="<?= !empty($_GET['id']) ? $article['date_expiration'] : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">

        <label for="images">Image</label>
        <input value="<?= !empty($_GET['id']) ? $article['images'] : "" ?>" type="file" name="images" id="images">

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
    <div style="display: block;" class="box table-responsive">
      <form action="" method="get">
        <table class="mtable">
          <tr>
            <th>Nom de l'article</th>
            <th>Catégorie</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Date de fabrication</th>
            <th>Date d'expiration</th>
          </tr>
          <tr>
            <td>
              <input type="text" name="nom_article" id="nom_article" placeholder="Nom de l'article">
            </td>
            <td>
              <select name="id_categorie" id="id_categorie">
                <option value="">--Choisir une catégorie--</option>
                <?php
                $categories = getCategorie();

                if (!empty($categories) && is_array($categories)) {
                  foreach ($categories as $categorie) {
                    ?>
                    <option 
                      <?= !empty($_GET['id']) && $article['id_categorie'] == $categorie['id'] ? "selected" : "" ?> value="<?= $categorie['id'] ?>"><?= $categorie['libelle_categorie'] ?>
                    </option>
                    <?php
                  }
                }
                ?>
              </select>
            </td>
            <td>
              <input type="number" name="quantite" id="quantite" placeholder="Quantité">
            </td>
            <td>
              <input type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Prix unitaire">
            </td>
            <td>
            <input type="date" name="date_fabrication" id="date_fabrication">
            </td>
            <td>
              <input type="date" name="date_expiration" id="date_expiration">
            </td>
          </tr>
        </table>
        <br>
        <button type="submit">Rechercher</button>
      </form>
      <br>
      <table class="mtable">
        <tr>
          <th>Nom de l'article</th>
          <th>Catégorie</th>
          <th>Quantité</th>
          <th>Prix unitaire</th>
          <th>Date de fabrication</th>
          <th>Date d'expiration</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        <?php
        if (!empty($_GET)) {
          $articles = getArticle(null, $_GET);
        } else {
          $articles = getArticle();
        }

        if (!empty($articles) && is_array($articles)) {
          foreach ($articles as $article) {
            ?>
            <tr>
              <td><?= $article['nom_article'] ?></td>
              <td><?= $article['libelle_categorie'] ?></td>
              <td><?= $article['quantite'] ?></td>
              <td><?= $article['prix_unitaire'] ?> €</td>
              <td><?= date('d/m/Y', strtotime($article['date_fabrication'])) ?></td>
              <td><?= date('d/m/Y', strtotime($article['date_expiration'])) ?></td>
              <td><img width="100" height="100" src="<?= $article['images'] ?>" alt="<?= $article['nom_article'] ?>"></td>
              <td><a href="?id=<?= $article['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
            </tr>
            <?php
          }
        }
        ?>
      </table>
    </div>
  </div>

</div>

<?php include '../partials/footer.php' ?>