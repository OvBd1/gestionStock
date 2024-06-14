<?php 
include '../partials/header.php';

if (!empty($_GET['id'])) {
  $article = getCommande($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifCommande.php" : "../model/ajoutCommande.php" ?>" method="post">
        <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="id_article">Article</label>
        <select onchange="setPrix()" name="id_article" id="id_article">
          <?php
          $articles = getArticle();

          if (!empty($articles) && is_array($articles)) {
            foreach ($articles as $article) {
              ?>
              <option data-prix="<?= $article['prix_unitaire']?>" value="<?= $article['id'] ?>"><?= $article['nom_article']. " - " . $article['quantite']. ' disponible' ?></option>
              <?php
            }
          }
          ?>
        </select>

        <label for="id_fournisseur">Fournisseur</label>
        <select name="id_fournisseur" id="id_fournisseur">
          <?php
          $fournisseurs = getFournisseur();

          if (!empty($fournisseurs) && is_array($fournisseurs)) {
            foreach ($fournisseurs as $fournisseur) {
              ?>
              <option value="<?= $fournisseur['id'] ?>"><?= $fournisseur['nom']. " " .$fournisseur['prenom']?></option>
              <?php
            }
          }
          ?>
        </select>

        <label for="quantite">Quantité</label>
        <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Quantité">

        <label for="prix">Prix</label>
        <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="Prix">

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
          <th>Article</th>
          <th>Fournisseur</th>
          <th>Quantité</th>
          <th>Prix</th>
          <th>Date de vente</th>
          <th>Action</th>
        </tr>
        <?php
        $ventes = getCommande();

        if (!empty($ventes) && is_array($ventes)) {
          foreach ($ventes as $vente) {
            ?>
            <tr>
              <td><?= $vente['nom_article'] ?></td>
              <td><?= $vente['nom']. " " .$vente['prenom'] ?></td>
              <td><?= $vente['quantite'] ?></td>
              <td><?= $vente['prix'] ?> €</td>
              <td><?= date('d/m/Y', strtotime($vente['date_commande'])) ?></td>
              <td>
                <a href="recuCommande.php?id=<?= $vente['id']?>"><i class='bx bx-receipt'></i></a>
                <a onclick="annuleCommande(<?= $vente['id']?>, <?= $vente['idArticle']?>, <?= $vente['quantite']?>)" style="color: red;"><i class='bx bx-stop-circle' ></i></a>
              </td>
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

<script>

  function annuleCommande(idCommande, idArticle, quantite) {
    if (confirm("Voulez-vous vraiment annuler cette vente ?")) {
      window.location.href = "../model/annuleCommande.php?idCommande=" + idCommande + "&idArticle=" + idArticle + "&quantite=" + quantite
    }
  }

  function setPrix() {
    let article = document.querySelector('#id_article')
    let quantite = document.querySelector('#quantite')
    let prix = document.querySelector('#prix')

    let prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix')

    prix.value = Number(quantite.value) * Number(prixUnitaire)

    console.log(prixUnitaire)
  }
</script>