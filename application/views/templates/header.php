<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Shooble</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/book.png">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/datepicker.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/standalone.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/js/clockpicker.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/clockpicker.css" rel="stylesheet">
</head>
<body>
 <header>
  <nav id="top" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">shooble</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link  <?php if (
            $this->uri->uri_string() == ""
        ) {
            echo "active";
        } ?>" href="<?php echo base_url(); ?>">Accueil</a></li>
        <?php if ($this->session->userdata("est_co")): ?> 
          <li class="nav-item"><a class="nav-link  <?php if (
              $this->uri->uri_string() == "sondages"
          ) {
              echo "active";
          } ?>" href="<?php echo base_url(); ?>sondages">Mes sondages</a></li>
        <?php endif; ?>
      </ul>

      <?php if (!$this->session->userdata("est_co")): ?>
        <ul class="navbar-nav navbar-right">
          <li><a class="nav-link <?php if (
              $this->uri->uri_string() == "utilisateurs/connexion"
          ) {
              echo "active";
          } ?>" href="<?php echo base_url(); ?>utilisateurs/connexion">Connexion</a></li>
          <li><a class="nav-link  <?php if (
              $this->uri->uri_string() == "utilisateurs/inscription"
          ) {
              echo "active";
          } ?>" href="<?php echo base_url(); ?>utilisateurs/inscription">Inscription</a></li>
        </ul>
      <?php endif; ?>

      <?php if ($this->session->userdata("est_co")): ?>
        <ul class="navbar-nav navbar-right">
          <li><a class="nav-link  <?php if (
              $this->uri->uri_string() == "sondages/create"
          ) {
              echo "active";
          } ?>" href="<?php echo base_url(); ?>sondages/create">Créer un sondage</a></li>
          <li><a class="nav-link <?php if (
              $this->uri->uri_string() == "utilisateurs/deconnexion"
          ) {
              echo "active";
          } ?>" href="<?php echo base_url(); ?>utilisateurs/deconnexion">Déconnexion</a></li>
        </ul>
      <?php endif; ?>
    </div>
  </nav>
</header>

<?php if ($this->session->userdata("est_co")): ?>
  <div class="text-right text-info user">
    <p style="color:black">Connecté en tant que <?php echo $this->session->userdata(
        "pseudo"
    ); ?></p>
  </div>
<?php endif; ?>
<div class="container">
  <br>
  <!-- Flash messages -->

  <?php if ($this->session->flashdata("sondage_cree")): ?>
    <?php echo '<p class="alert alert-success">' .
        $this->session->flashdata("sondage_cree") .
        "</p>"; ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata("sondage_modifie")): ?>
    <?php echo '<p class="alert alert-success">' .
        $this->session->flashdata("sondage_modifie") .
        "</p>"; ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata("sondage_supprime")): ?>
    <?php echo '<p class="alert alert-success">' .
        $this->session->flashdata("sondage_supprime") .
        "</p>"; ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata("utilisateur_inscrit")): ?>
    <?php echo '<p class="alert alert-success">' .
        $this->session->flashdata("utilisateur_inscrit") .
        "</p>"; ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata("connexion_echoue")): ?>
    <?php echo '<p class="alert alert-danger">' .
        $this->session->flashdata("connexion_echoue") .
        "</p>"; ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata("utilisateur_connecte")): ?>
    <?php echo '<p class="alert alert-success">' .
        $this->session->flashdata("utilisateur_connecte") .
        "</p>"; ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata("utilisateur_deconnecte")): ?>
    <?php echo '<p class="alert alert-success">' .
        $this->session->flashdata("utilisateur_deconnecte") .
        "</p>"; ?>
    <?php endif; ?>
