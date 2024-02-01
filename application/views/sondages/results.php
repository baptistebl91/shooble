<h2><?php echo $titre; ?></h2>
<h2><?php echo $sondage["titre"]; ?></h2>

<?php if ($participants->nbr > 0): ?>


	<p><?php echo $participants->nbr; ?> personne(s) a/ont participé(es) à votre sondage.</p>

	<p>Les créneaux horaires proposées étaient :  <br>1. le <?php echo $sondage[
     "date1"
 ]; ?> à <?php echo substr($sondage["heure1"] ?? "", 0, 5); ?><br>

		<?php if (
      $sondage["date2"] != null &&
      $sondage["heure2"] != null
  ): ?>2. le <?php echo $sondage["date2"]; ?> à <?php echo substr(
     $sondage["heure2"] ?? "",
     0,
     5
 ); ?><br><?php endif; ?>
		<?php if (
      $sondage["date3"] != null &&
      $sondage["heure3"] != null
  ): ?>3. le <?php echo $sondage["date3"]; ?> à <?php echo substr(
     $sondage["heure3"] ?? "",
     0,
     5
 );endif; ?></p>


		<p class="text-info">Nombre de votes pour le créneau 1 : <?php echo $cr1->nbr; ?><br>

			<?php if (
       $sondage["date2"] != null &&
       $sondage["heure2"] != null
   ): ?>Nombre de votes pour le créneau 2 : <?php echo $cr2->nbr; ?><br>

			<?php $creneau2 =
       "Le " .
       $sondage["date2"] .
       " à " .
       substr($sondage["heure2"] ?? "", 0, 5); ?>

			<?php endif; ?>

			<?php if (
       $sondage["date3"] != null &&
       $sondage["heure3"] != null
   ): ?>Nombre de votes pour le créneau 3 : <?php echo $cr3->nbr; ?></p>

			<?php $creneau3 =
       "Le " .
       $sondage["date3"] .
       " à " .
       substr($sondage["heure3"] ?? "", 0, 5); ?>

			<?php endif; ?>

	<br>

	<div id="chartContainer"></div>

	<?php $dataPoints = [
     [
         "x" => 20,
         "y" => $cr1->nbr,
         "indexLabel" =>
             "Le " .
             $sondage["date1"] .
             " à " .
             substr($sondage["heure1"] ?? "", 0, 5),
     ],
     [
         "x" => 30,
         "y" => $cr2->nbr,
         "indexLabel" =>
             "Le " .
             $sondage["date2"] .
             " à " .
             substr($sondage["heure2"] ?? "", 0, 5),
     ],
     [
         "x" => 40,
         "y" => $cr3->nbr,
         "indexLabel" =>
             "Le " .
             $sondage["date3"] .
             " à " .
             substr($sondage["heure3"] ?? "", 0, 5),
     ],
 ]; ?>

	<?php include "graph.php"; ?>

	<?php else: ?>
		<br>
		<p>Personne n'a participé à votre sondage.</p>
		<p style="color:black">Partagez votre sondage en envoyant ce lien aux participants : <a href=" <?php echo $_SERVER[
      "HTTP_HOST"
  ] .
      "" .
      base_url() .
      "sondages/" .
      $sondage["hash_titre"]; ?>"> <?php echo $_SERVER["HTTP_HOST"] .
    "" .
    base_url() .
    "sondages/" .
    $sondage["hash_titre"]; ?></a> !</p>
	<?php endif; ?>


