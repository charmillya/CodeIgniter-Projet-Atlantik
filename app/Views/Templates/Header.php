<html>
<head>
<meta charset="utf-8">
    <title><?php echo $TitreDeLaPage ?></title>
<!-- charset=UTF-8 : pour que les caractères accentués ressortent correctement -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- la balise ci-dessus indique que l'affichage doit se faire sur la totalité de l'écran, par défaut voir Responsive Design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href=<?= css_url('atlantik') ?>></link>
</head>
<body>
    
<style>
    .navbar {
        border-bottom: 1px solid white;
    }
</style>

<nav class="navbar navbar-dark blackBg navbar-expand-sm fixed-top">
  <div class="container-fluid text-light">
  <ul class="navbar-nav">
    <a class="navbar-brand Logo txtHyperlink" href="/"><b>Atlantik</b></a>
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Consulter</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="afficherliaisons">Consulter les liaisons par secteur</a></li>
      </ul>
    </li> 
  </ul>
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['prenom'])) {
          echo '<li class="nav-item"><text class="nav-link text-light"><i> Bonjour, <b>' . $_SESSION['prenom'] . '</i></b></text></li>';
      }?>

      <?php if(!isset($_SESSION['mel'])) {
        echo '<li class="nav-item">
          <a class="nav-link txtHyperlink" href="connexion">Me connecter</a>
        </li>';
      } else { 
        echo '<li class="nav-item">
          <a class="nav-link txtHyperlink" href="deconnexion">Déconnexion</a>
        </li>';
      }?>
    </ul>
  </div>
</nav>  
