<h2><?php echo $sondage["titre"]; ?></h2>
<br>


<small class="post-date" style="text-align:center"><strong>Créé le <?php echo $sondage[
    "created_at"
]; ?> par <?php echo $createur->pseudo; ?></strong></small><br>

<br>
<?php if (
    $this->session->userdata("id_utilisateur") == $sondage["id_utilisateur"]
): ?>
<p style="color:black" >Voici le lien pour partager votre sondage : <a href=" <?php echo base_url() .
    "sondages/" .
    $sondage["hash_titre"]; ?>"> <?php echo base_url() .
    "sondages/" .
    $sondage["hash_titre"]; ?></a></p>
<br>
<?php endif; ?>
<p style="color:black">Ville : <?php echo $sondage[
    "lieu"
]; ?><br> Date et heure du rendez-vous :  <br> le <?php echo $sondage[
    "date1"
]; ?> à <?php echo substr($sondage["heure1"], 0, 5); ?><br>
	
	<?php if (
     !$sondage["date2"] == null &&
     !$sondage["heure2"] == null
 ): ?> le <?php echo $sondage["date2"]; ?> à <?php echo substr(
     $sondage["heure2"],
     0,
     5
 ); ?><br><?php endif; ?>
	<?php if (
     !$sondage["date3"] == null &&
     !$sondage["heure3"] == null
 ): ?> le <?php echo $sondage["date3"]; ?> à <?php echo substr(
     $sondage["heure3"],
     0,
     5
 );endif; ?></p>

	<?php if (
     $this->session->userdata("id_utilisateur") == $sondage["id_utilisateur"]
 ): ?>
	<hr>
	<h2>Votre sondage</h2>
	<br>

<div class="btn-group" role="group" aria-label="Basic example">

		<?php if ($sondage["closed_survey"]): ?>
			<?php echo form_open("/sondages/results/" . $sondage["hash_titre"]); ?>
			<input type="submit" value="Résultats" class="btn btn-success">
			</form>
		<?php endif; ?>

		<?php echo form_open("/sondages/edit/" . $sondage["hash_titre"]); ?>
		<input type="submit" value="Modifier" class="btn btn-info">
		</form>
		<?php echo form_open("/sondages/delete/" . $sondage["ids"]); ?>
		<input type="submit" value="Supprimer" class="btn btn-danger">
		</form>
		</div>
<?php endif; ?>

<hr>

<?php if ($this->session->userdata("est_co")): ?>

	<h2 id="participants"> Participants </h2>
	<br>
	<?php if ($reponses): ?>

		<?php foreach ($reponses as $reponse): ?>

			<?php $heure_rep = explode(" ", $reponse["created_at"]); ?>
			<?php $creneau = explode(" ", $reponse["creneau"]); ?>

			<div class="card text-white bg-secondary mb-3">
				<div class="card-header">	
					<p><strong><?php echo $reponse[
         "pseudo"
     ]; ?></strong> a participé au sondage le <?php echo $heure_rep[0]; ?> à <?php echo substr(
     $heure_rep[1],
     0,
     5
 ); ?></p>
				</div>
				<div class="card-body">
					<p class="align-left"><strong>Créneaux horaire choisi :</strong> le <?php echo $creneau[0]; ?> à <?php echo substr(
     $creneau[1],
     0,
     5
 ); ?></p>
					<?php if ($reponse["description"] != ""): ?>
						<p  class="align-left"><strong>Réponse :</strong> <?php echo $reponse[
          "description"
      ]; ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
		<?php else: ?>
			<p>Personne n'a participé à ce sondage pour l'instant.</p>
		<?php endif; ?>
		<hr>


		<?php if (!$sondage["closed_survey"]): ?>
			<?php if (
       $this->session->userdata("id_utilisateur") != $sondage["id_utilisateur"]
   ): ?>

			<?php echo validation_errors(); ?>
			<?php echo form_open("reponses/create/" . $sondage["ids"]); ?>
			<h2 id="rep">Répondre</h2>
			<br>
			<?php if ($nbrep->test < 1): ?>
				<div class="form-group">
					<label>Choississez une/des date(s) proposées par <?php echo $createur->pseudo; ?></label>
					<select class="custom-select" name="creneau">
						<option value="<?php echo $sondage["date1"]; ?> <?php echo substr(
     $sondage["heure1"],
     0,
     5
 ); ?>">le <?php echo $sondage["date1"]; ?> à <?php echo substr(
     $sondage["heure1"],
     0,
     5
 ); ?></option>
						<?php if (!$sondage["date2"] == null && !$sondage["heure2"] == null): ?> 
						<option value="<?php echo $sondage["date2"]; ?> <?php echo substr(
     $sondage["heure2"],
     0,
     5
 ); ?>">
							le <?php echo $sondage["date2"]; ?> à <?php echo substr(
     $sondage["heure2"],
     0,
     5
 ); ?>
						</option>
					<?php endif; ?>
					<?php if (!$sondage["date3"] == null && !$sondage["heure3"] == null): ?> 
					<option value="<?php echo $sondage["date3"]; ?> <?php echo substr(
     $sondage["heure3"],
     0,
     5
 ); ?>">le <?php echo $sondage["date3"]; ?> à <?php echo substr(
     $sondage["heure3"],
     0,
     5
 ); ?></option>			
				<?php endif; ?>
			</select>
		</div>

		<div class="form-group">
			<label>Ajoutez un message (facultatif)</label>
			<textarea rows="6" cols="50" class="form-control" name="description" placeholder="Ajoutez une description"></textarea>
		</div>

		<input type="hidden" name="hash_titre" value="<?php echo $sondage[
      "hash_titre"
  ]; ?>">
		<button class="btn btn-primary" type="submit">Valider</button>
	</form>

	<?php else: ?>
		<p>Vous avez déjà participé à ce sondage.</p>
	<?php endif; ?>

<?php endif; ?>
<?php else: ?>
	<p class="text-danger">Le sondage a été cloturé. Vous ne pouvez donc plus y participer.</p>

<?php endif; ?>

<?php else: ?>

	<?php if ($sondage["closed_survey"]): ?>
		<p class="text-danger">Le sondage a été cloturé. Vous ne pouvez donc plus y participer.</p>
		<p><a href="<?php echo base_url(); ?>/utilisateurs/connexion">Connectez-vous</a> ou <a href="<?php echo base_url(); ?>/utilisateurs/inscription">inscrivez-vous</a> pour répondre à ce sondage et voir les commentaires.</p>
		<?php else: ?>
			<p><a href="<?php echo base_url(); ?>/utilisateurs/connexion">Connectez-vous</a> ou <a href="<?php echo base_url(); ?>/utilisateurs/inscription">inscrivez-vous</a> pour répondre à ce sondage et voir les commentaires.</p>
		<?php endif; ?>
	<?php endif; ?>
