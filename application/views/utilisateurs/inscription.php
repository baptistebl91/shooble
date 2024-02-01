	<?php echo validation_errors(); ?>

	<?php echo form_open("utilisateurs/inscription"); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 form">
			<br>
			<h1 class="text-center"><?php echo $titre; ?></h1>
			<br>
			<div class="form-group">
				<input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo set_value(
        "nom"
    ); ?>" autofocus>
			</div>

			<div class="form-group">
				<input type="text" class="form-control" name="prenom" value="<?php echo set_value(
        "prenom"
    ); ?>" placeholder="Prénom">
			</div>

			<div class="form-group">
				<input type="email" class="form-control" name="email" value="<?php echo set_value(
        "email"
    ); ?>" placeholder="Email">

			</div>

			<div class="form-group">
				<input type="text" class="form-control" name="pseudo" value="<?php echo set_value(
        "pseudo"
    ); ?>" placeholder="Nom d'utilisateur">
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="mot_de_passe" placeholder="Mot de passe">

			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="mot_de_passe2" placeholder="Confirmation du mot de passe">
				<small class="form-text text-muted">Tous les champs sont requis.</small>
			</div>

			<button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
			<br>
			<p>Vous avez déjà un compte ? <a href ="<?php echo base_url(); ?>utilisateurs/connexion">Connectez-vous ! </a></p>
		</div>
	</div>
	<?php echo form_close(); ?>

