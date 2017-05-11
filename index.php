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
//define('URL', "http://lwachter.mycpnv.ch/kairos");

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
    <title><?php echo $title; ?></title>

    <link href="<?php echo ROOT;?>/assets/css/bootstrap-cosmo.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ROOT;?>/assets/css/kairos-style.css" rel="stylesheet" type="text/css"/>

    <!-- JavaScript libraries -->
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/assets/js/bootstrap.min.js"></script>
  </head>
  <body>
	<!-- Navigation -->
    <nav class="navbar navbar-inverse">
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

		<?php if(isset($_SESSION['isConnected'])){ ?>
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo URL; ?>?page=home">Projets<span class="sr-only">(current)</span></a></li>
              <li><a href="<?php echo URL; ?>?page=journal">Journal</a></li>
              <?php if($_SESSION['isAdmin']){ ?> <li><a href="<?php echo URL; ?>?page=admin">Administration</a></li> <?php } ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['pseudo'];?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo URL; ?>?page=profile">Modifier profil</a></li>
                  <li><a href="<?php echo URL; ?>?page=logout">Déconnexion</a></li>
                </ul>
              </li>
            </ul>
          </div>
	    <?php } ?>
      </div>
    </nav>
    <!-- Fin de Navigation -->

	<!-- Inclusion de la page -->
	<div class="container">
	  <?php
	  	$pagePath = ROOT."/sources/pages/".$page.".php";
	  	if(file_exists($pagePath)){
	  		include($pagePath);
		}
		else{
			header("location:".URL."?page=unknown");
		}
	  ?>
	</div>
	<!-- Fin de la page -->

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
    <!-- Fin du footer -->
  </body>
</html>