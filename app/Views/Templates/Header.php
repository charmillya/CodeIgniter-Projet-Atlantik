<html>
<head>
<meta charset="utf-8">
    <title><?php echo $TitreDeLaPage ?></title>
<!-- charset=UTF-8 : pour que les caractères accentués ressortent correctement -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- la balise ci-dessus indique que l'affichage doit se faire sur la totalité de l'écran, par défaut voir Responsive Design -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href=<?= css_url('atlantik') ?>></link>
</head>
<body>
    
<style>
    .navbar {
        border-bottom: 1px solid white;
    }
</style>

<nav class="navbar blackBg navbar-expand-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><b>Atlantik</b></a>
    <ul class="navbar-nav justify-content-center text-light">
      <?php if(isset($_SESSION['prenom'])) {
        echo '<i> Bonjour, vous êtes connecté.e en tant que ' . '<b>' . $_SESSION['prenom'] . '</b>' . '.</i>';
      }?>
      </li>
    </ul>
    <ul class="navbar-nav">
      <?php if(!isset($_SESSION['mel'])) {
        echo '<li class="nav-item">
          <a class="nav-link" href="connexion">Me connecter</a>
        </li>';
      } else { 
        echo '<li class="nav-item">
          <a class="nav-link" href="deconnexion">Déconnexion</a>
        </li>';
      }?>
      </li>
    </ul>
  </div>
</nav>  
