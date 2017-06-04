<?php
//--------------------------
//Filename: index.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: Main page, includes scripts and secondary pages
//--------------------------

session_start();
//Definition of the path to the document root
define('ROOT', dirname('index.php'));
//Definition of the path to the site's index
define('URL', "http://kairos");
//define('URL', "http://lwachter.mycpnv.ch");

//Definition of the current page using the querystring
$page = 'home';
if(isset($_GET['page']) && $_GET['page'] != ''){
    $page = htmlspecialchars($_GET['page']);
}

//Restrict access to login and register for unconnected users
if(!isset($_SESSION['isConnected'])){
	if($page != "login"  && $page != "register")
		header('location:'.URL.'?page=login&info=notco');
}

//Inclusion of the DB connection function, and others
include(ROOT."/sources/shared/functions.php");

//Inclusion of the script associated to the page
$script = ROOT."/sources/scripts/".$page."Script.php";
if(file_exists($script)){
    include($script);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?></title>

    <link href="<?php echo ROOT;?>/assets/css/bootstrap-cosmo.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ROOT;?>/assets/css/kairos-style.css" rel="stylesheet" type="text/css"/>

    <!-- JavaScript libraries -->
    <script type="text/javascript" src="<?php echo ROOT;?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT;?>/assets/js/bootstrap.min.js" defer></script>
    <script type="text/javascript" src="<?php echo ROOT;?>/assets/js/displayDetails.js" defer></script>
    <script type="text/javascript" src="<?php echo ROOT;?>/assets/js/stopwatch.js" defer></script>
  </head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo URL;?>">KairosProjects</a>
      </div>

      <!-- Main navbar -->
      <?php if(isset($_SESSION['isConnected'])){ ?>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li class="<?php if($page=='home') echo 'active';?>">
              <a href="<?php echo URL;?>?page=home">Projets</a>
            </li>
            <li class="<?php if($page=='journal') echo 'active';?>">
              <a href="<?php echo URL;?>?page=journal">Journal</a>
            </li>
            <?php if($_SESSION['isAdmin']){ ?> 
              <li class="<?php if($page=='admin') echo 'active';?>">
                <a href="<?php echo URL;?>?page=admin">Administration</a>
              </li>
            <?php } ?>
          </ul>

          <!-- Profile controls -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown <?php if($page=='profile') echo 'active'; ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span>
                <?php echo $_SESSION['pseudo'];?>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo URL;?>?page=profile">Modifier profil</a></li>
                <li><a href="<?php echo URL;?>?page=logout">Déconnexion</a></li>
              </ul>
            </li>
          </ul>
        </div>
      <?php } ?>
    </div>
  </nav>
  <!-- End of navigation -->

  <!-- Content of the page -->
  <div class="container">
    <!-- Administrator mode warning -->
    <?php if(isset($admin) && $admin){ ?>
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p><strong>Attention!</strong> Vous êtes actuellement en mode administrateur, où vous pouvez modifier et supprimer les données des autres utilisateurs.</p> 
        <p>Pour revenir sur vos données personnelles, cliquez simplement sur l'un des onglets ci-dessus.</p>
      </div>
    <?php } ?>
    <!-- End of administrator mode warning -->

    <?php
      //Set the path to the page to include
      $pagePath = ROOT."/sources/pages/".$page.".php";

      //If the file exists, include the page, if not show unknown message
      if(file_exists($pagePath)){
        include($pagePath);
      }
      else{
        header("location:".URL."?page=unknown");
      }
    ?>
  </div>
  <!-- End of the page -->

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <hr>
          <small>CPNV - Luc Wachter</small><br>
          <small>Built with Bootstrap and the "Cosmo" Bootswatch theme</small>
        </div>
      </div>
    </div>
  </footer>
  <!-- End of footer -->
</body>
</html>