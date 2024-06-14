<?php
include '../partials/header.php';

if (!empty($_GET['id'])) {
  $vente = getVente($_GET['id']);
}
?>

<div class="home-content">
  <button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"><i class='bx bx-printer'></i>Imprimer</button>
  <div class="page">
    <div class="cote-a-cote">
      <h2>CSF Stock</h2>
      <div>
        <p>Reçu N : <?= $vente['id'] ?></p>
        <p>Date : <?= date('d/m/Y', strtotime($vente['date_vente'])) ?></p>
      </div>
    </div>
    <div class="cote-a-cote" style="width: 50%;">
      <p>Nom : </p>
      <p><?= $vente['nom'] . " " . $vente['prenom'] ?></p>
    </div>
    <div class="cote-a-cote" style="width: 50%;">
      <p>Telephone : </p>
      <p><?= $vente['telephone'] ?></p>
    </div>
    <div class="cote-a-cote" style="width: 50%;">
      <p>Adresse : </p>
      <p><?= $vente['adresse'] ?></p>
    </div>

    <br>

    <table class="mtable">
      <tr>
        <th>Designation</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
        <th>Prix Total</th>
      </tr>
      <tr>
        <td><?= $vente['nom_article'] ?></td>
        <td><?= $vente['quantite'] ?></td>
        <td><?= $vente['prix_unitaire'] ?> €</td>
        <td><?= $vente['prix'] ?> €</td>
      </tr>

    </table>
  </div>


</div>

<?php
include '../partials/footer.php';
?>

<script>

  let btnPrint = document.querySelector('#btnPrint')
  btnPrint.addEventListener('click', () => {
    window.print()
  })

  function setPrix() {
    let article = document.querySelector('#id_article')
    let quantite = document.querySelector('#quantite')
    let prix = document.querySelector('#prix')

    let prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix')

    prix.value = Number(quantite.value) * Number(prixUnitaire)

    console.log(prixUnitaire)
  }
</script>