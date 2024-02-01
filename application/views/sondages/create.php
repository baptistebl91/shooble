<h2><?= $titre ?></h2>

<?php echo validation_errors(); ?>
<?php echo form_open_multipart("sondages/create"); ?>


<div class="form-group">
	<label>Titre</label>
	<input type="text" class="form-control" value="<?php echo set_value(
     "titre"
 ); ?>" name="titre" placeholder="Ajoutez un titre" required>
</div>
<div class="form-group">
	<label>Description</label>
	<textarea rows="6" cols="50" class="form-control" name="description" placeholder="Ajoutez une description" required><?php echo set_value(
     "description"
 ); ?></textarea>
</div>
<div class="form-group">
	<label>Lieu</label>
	<input type="text" class="form-control" name="lieu" value="<?php echo set_value(
     "lieu"
 ); ?>" placeholder="Ajoutez un lieu" required>
</div>
<hr>
<h2>Créneaux horaires </h2>

<div class="col-md-4 col-md-offset-4 form left">
	<div class="form-group">
		<label>Heure 1 (Obligatoire)</label>
		<input type="text" readonly class="form-control clockpicker"  value="<?php echo set_value(
      "heure1"
  ); ?>" data-autoclose="true" name="heure1" placeholder="Cliquez pour sélectionner une heure" required>
		<br>
		<label>Date 1 (Obligatoire)</label>
		<input type="text" readonly class="form-control datepicker" value="<?php echo set_value(
      "date1"
  ); ?>" id="datepicker1" name="date1"  placeholder="Cliquez pour sélectionner une date" required>
	</div>
</div>
<div class="col-md-4 col-md-offset-4 form left">
	<div class="form-group">
		<label>Heure 2 (Facultatif)</label>
		<input type="text" readonly class="form-control clockpicker" value="<?php echo set_value(
      "heure2"
  ); ?>" data-autoclose="true" name="heure2" placeholder="Cliquez pour sélectionner une heure">
		<br>
		<label>Date 2 (Facultatif)</label>
		<input type="text" readonly class="form-control datepicker" value="<?php echo set_value(
      "date2"
  ); ?>" id="datepicker2" name="date2" placeholder="Cliquez pour sélectionner une date">
	</div>
</div>
<div class="col-md-4 col-md-offset-4 form left">
	<div class="form-group">
		<label>Heure 3 (Facultatif)</label>
		<input type="text" readonly class="form-control clockpicker" value="<?php echo set_value(
      "heure3"
  ); ?>" data-autoclose="true" name="heure3" placeholder="Cliquez pour sélectionner une heure">
		<br>
		<label>Date 3 (Facultatif)</label>
		<input type="text" readonly class="form-control datepicker" value="<?php echo set_value(
      "date3"
  ); ?>" id="datepicker3" name="date3" placeholder="Cliquez pour sélectionner une date">
	</div>
</div>
<br>
<p class="text-danger">Remplissez au minimum le premier créneau horaire.</p>

<button type="submit" class="btn btn-default">Créer</button>
</form>

<script>

	$('.clockpicker').clockpicker();

</script>

