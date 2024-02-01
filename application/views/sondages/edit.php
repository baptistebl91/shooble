<h2><?= $titre ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open("sondages/update"); ?>
<input type="hidden" name="ids" value="<?php echo $sondage["ids"]; ?>">
<br>
<div class="form-group">
  <label>Titre</label>
  <input type="text" class="form-control" name="titre" placeholder="Ajoutez un titre" value="<?php echo $sondage[
      "titre"
  ]; ?>">
</div>

<div class="form-group">
  <label>Description</label>
  <textarea rows="6" cols="50" class="form-control" name="description"><?php echo $sondage[
      "description"
  ]; ?></textarea>
</div>  

<div class="form-group">
  <label>Lieu</label>
  <input type="text" class="form-control" name="lieu" placeholder="Ajoutez un lieu" value="<?php echo $sondage[
      "lieu"
  ]; ?>">
</div>

<hr>
<h2>Créneaux horaires </h2>

<div class="col-md-4 col-md-offset-4 form left">
  <div class="form-group">
    <label>Heure 1 (Obligatoire)</label>
    <input type="text" readonly class="form-control clockpicker"  data-autoclose="true" name="heure1" value="<?php echo substr(
        $sondage["heure1"],
        0,
        5
    ); ?>" placeholder="Cliquez pour sélectionner une heure" required>
    <br>
    <label>Date 1 (Obligatoire)</label>
    <input type="text" readonly class="form-control datepicker" id="datepicker1" name="date1"  value="<?php echo $sondage[
        "date1"
    ]; ?>" placeholder="Cliquez pour sélectionner une date" required>
  </div>
</div>
<div class="col-md-4 col-md-offset-4 form left">
  <div class="form-group">
    <label>Heure 2 (Facultatif)</label>
    <input type="text" readonly class="form-control clockpicker"  data-autoclose="true" name="heure2" value="<?php echo substr(
        $sondage["heure2"] ?? "",
        0,
        5
    ); ?>" placeholder="Cliquez pour sélectionner une heure" >
    <br>
    <label>Date 2 (Facultatif)</label>
    <input type="text" readonly class="form-control datepicker" id="datepicker2" name="date2" value="<?php echo $sondage[
        "date2"
    ] ?? ""; ?>" placeholder="Cliquez pour sélectionner une date">
  </div>
</div>
<div class="col-md-4 col-md-offset-4 form left">
  <div class="form-group">
    <label>Heure 3 (Facultatif)</label>
    <input type="text" readonly class="form-control clockpicker"  data-autoclose="true" name="heure3" value="<?php echo substr(
        $sondage["heure3"] ?? "",
        0,
        5
    ); ?>" placeholder="Cliquez pour sélectionner une heure" >
    <br>
    <label>Date 3 (Facultatif)</label>
    <input type="text" readonly class="form-control datepicker" id="datepicker3" name="date3" value="<?php echo $sondage[
        "date3"
    ] ?? ""; ?>" placeholder="Cliquez pour sélectionner une date">
  </div>
</div>
<br>
<p class="text-danger">Remplissez au minimum le premier créneau horaire.</p>
<br>
<input name="closed" type=checkbox <?php echo $sondage["closed_survey"] == 1
    ? "checked"
    : ""; ?>> Clore le sondage<br>
<br>

<button type="submit" class="btn btn-default">Valider</button>
</form>

<script>

  $('.clockpicker').clockpicker();

</script>
