<?php echo form_open("utilisateurs/connexion"); ?>
<div class="row">
	<div class="col-md-4 col-md-offset-4 form">
		<br>
		<h1 class="text-center"><?php echo $titre; ?></h1>
		<br>
		<div class="form-group">
			<input type="text" name="pseudo" class="form-control" placeholder="Nom d'utilisateur" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Connexion</button>
		<br>
<p>Vous n'avez pas encore de compte ?<a href ="<?php echo base_url(); ?>utilisateurs/inscription"> S'inscrire en cliquant ici </a></p>	</div>
</div>
<?php echo form_close(); ?>
