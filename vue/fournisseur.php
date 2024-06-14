<?php 
include '../partials/header.php'; 

if (!empty($_GET['id'])) {
  $fournisseur = getFournisseur($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifFournisseur.php" : "../model/ajoutFournisseur.php" ?>" method="post">
        <label for="nom">Nom</label>
        <input value="<?= !empty($_GET['id']) ? $fournisseur['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Nom">
        <input value="<?= !empty($_GET['id']) ? $fournisseur['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="prenom">Prénom</label>
        <input value="<?= !empty($_GET['id']) ? $fournisseur['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Prénom">

        <label for="telephone">N° de téléphone</label>
        <input value="<?= !empty($_GET['id']) ? $fournisseur['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Téléphone">

        <label for="adresse">Adresse</label>
        <input value="<?= !empty($_GET['id']) ? $fournisseur['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="Adresse">

        <button type="submit">Valider</button>

        <?php
        if (!empty($_SESSION['message']['text'])) {
          ?>
          <div class="alert <?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
          </div>
        <?php
        }
        ?>

      </form>
    </div>
    <div class="box table-responsive">
      <table class="mtable">
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Téléphone</th>
          <th>Adresse</th>
          <th>Action</th>
        </tr>
        
        <?php
        $fournisseurs = getFournisseur();

        if (!empty($fournisseurs) && is_array($fournisseurs)) {
          foreach ($fournisseurs as $fournisseur) {
            ?>
            <tr>
              <td><?= $fournisseur['nom'] ?></td>
              <td><?= $fournisseur['prenom'] ?></td>
              <td><?= $fournisseur['telephone'] ?></td>
              <td><?= $fournisseur['adresse'] ?></td>
              <td><a href="?id=<?= $fournisseur['id']?>"><i class='bx bx-edit-alt'></i></a></td>
            </tr>
            <?php
          }
        }
        ?>
      </table>
    </div>
  </div>

</div>

<?php include '../partials/footer.php'; ?>