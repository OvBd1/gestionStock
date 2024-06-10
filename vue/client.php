<?php 
include '../partials/header.php'; 

if (!empty($_GET['id'])) {
  $client = getClient($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifClient.php" : "../model/ajoutClient.php" ?>" method="post">
        <label for="nom">Nom</label>
        <input value="<?= !empty($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Nom">
        <input value="<?= !empty($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id">

        <label for="prenom">Prénom</label>
        <input value="<?= !empty($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Prénom">

        <label for="telephone">N° de téléphone</label>
        <input value="<?= !empty($_GET['id']) ? $client['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Téléphone">

        <label for="adresse">Adresse</label>
        <input value="<?= !empty($_GET['id']) ? $client['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="Adresse">

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
        $clients = getClient();

        if (!empty($clients) && is_array($clients)) {
          foreach ($clients as $client) {
            ?>
            <tr>
              <td><?= $client['nom'] ?></td>
              <td><?= $client['prenom'] ?></td>
              <td><?= $client['telephone'] ?></td>
              <td><?= $client['adresse'] ?></td>
              <td><a href="?id=<?= $client['id']?>"><i class='bx bx-edit-alt'></i></a></td>
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