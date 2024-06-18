<?php include '../partials/header.php'; ?>

<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Commande</div>
        <div class="number"><?= getAllCommande()['nb'] ?></div>
        <div class="indicator">
          <i class="bx bx-up-arrow-alt"></i>
          <span class="text">Depuis hier</span>
        </div>
      </div>
      <i class="bx bx-cart-alt cart"></i>
    </div>
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Vente</div>
        <div class="number"><?= getAllVente()['nb'] ?></div>
        <div class="indicator">
          <i class="bx bx-up-arrow-alt"></i>
          <span class="text">Depuis hier</span>
        </div>
      </div>
      <i class="bx bxs-cart-add cart two"></i>
    </div>
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Article</div>
        <div class="number"><?= getAllArticle()['nb'] ?></div>
        <div class="indicator">
          <i class="bx bx-up-arrow-alt"></i>
          <span class="text">Depuis hier</span>
        </div>
      </div>
      <i class="bx bx-cart cart three"></i>
    </div>
  </div>

  <div class="sales-boxes">
    <div class="recent-sales box">
      <div class="title">Vente recentes</div>
      <?php $ventes = getLastVente() ?>
      <div class="sales-details">
        <ul class="details">
          <li class="topic">Date</li>
          <?php foreach ($ventes as $vente) {
            ?>
            <li><a href="#"><?= date('d/M/Y', strtotime($vente['date_vente'])) ?></a></li>
            <?php
          }
          ?>
        </ul>
        <ul class="details">
          <li class="topic">Client</li>
          <?php foreach ($ventes as $vente) {
            ?>
            <li><a href="#"><?= $vente['nom'] . ' ' . $vente['prenom'] ?></a></li>
            <?php
          }
          ?>
        </ul>
        <ul class="details">
          <li class="topic">Article</li>
          <?php foreach ($ventes as $vente) {
            ?>
            <li><a href="#"><?= $vente['nom_article'] ?></a></li>
            <?php
          }
          ?>
        </ul>
        <ul class="details">
          <li class="topic">Prix</li>
          <?php foreach ($ventes as $vente) {
            ?>
            <li><a href="#"><?= number_format($vente['prix'], 0, ",", " ") ?></a></li>
            <?php
          }
          ?>
        </ul>
      </div>
      <div class="button">
        <a href="#">Voir Tout</a>
      </div>
    </div>
    <div class="top-sales box">
      <div class="title">Article le plus vendu</div>
      <ul class="top-sales-details">
        <?php
        $articles = getMostVente();

        foreach ($articles as $article) {
          ?>
          <li>
            <a href="#">
              <span class="product"><?= $article['nom_article'] ?></span>
            </a>
            <span class="price"><?= number_format($article['prix'], 0, ",", " ") ?></span>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</div>
</section>

<?php include '../partials/footer.php' ?>