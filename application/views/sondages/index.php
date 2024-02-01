<h2><?= $titre ?></h2>
  <br>
  <?php if ($nbr_sondages->reponse != 0): ?>
    <?php foreach ($sondages as $sondage): ?>
      <div class="jumbotron">
        <h3 style="text-align:center"><?php echo $sondage["titre"]; ?></h3><br>
        <?php if ($sondage["closed_survey"]): ?>
          <p class="text-danger">Fermé</p>
        <?php endif; ?>
        <div class="justify">
          <small class="post-date" style="text-align:center"><strong>Créé le <?php echo $sondage[
          "created_at"
      ]; ?></strong></small>
          <br>
          <?php echo word_limiter($sondage["description"], 60); ?>
          <br>
          <br>
          <p><a class="btn btn-secondary" href="<?php echo site_url(
          "/sondages/" . $sondage["hash_titre"]
      ); ?>">Lire la suite</a></p>
        </div>
      </div>
    <?php endforeach; ?>
    <?php else: ?>
      <p>Aucun sondage créé pour l'instant. <a href="<?php echo site_url(
        "/sondages/create"
    ); ?>">Cliquez ici</a> pour en créer un tout de suite.</p>
    <?php endif; ?>





