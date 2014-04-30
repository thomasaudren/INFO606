<?php
error_reporting(E_ALL);
require("bd.php");
require("Utilisateur.php");
require("Transaction.php");

define("TITRE_SITE", "Plateforme éducative");
define("AUTEUR_SITE", "Cyril Rabat");
define("DATE_SITE", "2014");

global $pages;
$pages = array("Jeux", "jeux.php", false, array("Jeu de dés", "jeux_des.php", false),
			   "Profil", "profil.php", false, array("Gestion du profil", "profil_gestion.php", false, 
			                                        "Statistiques", "profil_stats.php", false)
              );

function afficheMenu($courant) {
	global $pages;
?>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php"><?php echo TITRE_SITE; ?></a>
        </div>
        <div class="collapse navbar-collapse ">
          <ul class="nav navbar-nav">
<?php
for($i = 0; $i < sizeof($pages); $i += 4) {
	if(($pages[$i + 2] == false)||($_SESSION['intervenant']->idintervenant == 1)) {
		echo "<li class=\"dropdown\">\n";
	    echo "  <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$pages[$i]." <b class=\"caret\"></b></a>\n";
		echo "  <ul class=\"dropdown-menu\">\n";
		for($j = 0; $j < sizeof($pages[$i + 3]); $j += 3) {
			if(($pages[$i + 3][$j + 2] == false)||($_SESSION['intervenant']->idintervenant == 1)) {
				echo "    <li";
				if(strcmp($pages[$i + 3][$j], $courant) == 0)
					echo " class=\"active\"";
				echo "><a href=\"".$pages[$i + 3][$j + 1]."\">".$pages[$i + 3][$j]."</a>\n";		
				echo "    </li>\n";
			}
		}
		echo "  </ul>\n";
	    echo "</li>\n";
	}
}
?>
          </ul>                            
          <p class="navbar-text navbar-right">
          Connecté en tant que <a href="index.php?action=deconnexion" class="navbar-link" title="Déconnexion"><?php echo Utilisateur::getNom(); ?>&nbsp;<i class="icon-eject"></i></a>
          </p>     
        </div>
      </div>
    </div>
<?php	
}

function sousmenu($first,$second="") {
	global $pages;
	
	$i = 0;
	while(($i < sizeof($pages)) && ($pages[$i] != $first)) $i += 4;
	
	if($second == "") {
		echo "<ul class=\"breadcrumb\">\n";
	    echo "  <li><a href=\"main.php\">Home</a> <span class=\"divider\"></span></li>\n";
	    echo "  <li class=\"active\">".$pages[$i]."</li>\n";
	    echo "</ul>\n";		
	}
	else {
		echo "<ul class=\"breadcrumb\">\n";
	    echo "  <li><a href=\"main.php\">Home</a> <span class=\"divider\"></span></li>\n";
	    echo "  <li><a href=\"".$pages[$i + 1]."\">".$pages[$i]."</a> <span class=\"divider\"></span></li>\n";
	    echo "  <li class=\"active\">$second</li>\n";
	    echo "</ul>\n";
	}
		
	echo "<hr/>\n";
	
	if($second != "")
		echo "<h2>$second</h2>\n";
	else
		echo "<h2>$first</h2>\n";	
}

function enteteHTML() {
?>	
<!DOCTYPE html>
<html lang="fr">
  <head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title><?php echo TITRE_SITE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo TITRE_SITE; ?>">
    <meta name="author" content="<?php echo AUTEUR_SITE; ?>">

    <link rel="icon" type="image/png" href="bootstrap/image/favicon.png" />    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="bootstrap/css/theme.css" rel="stylesheet">
<?php	
}

function entete($courant = "Home") {
	enteteHTML();
?>
  </head>
  <body>
<?php afficheMenu($courant); ?>
    <div class="container">
<?php
}

function footer() {
?>
      <hr>
      <footer>
        <p>&copy; <?php echo AUTEUR_SITE." ".DATE_SITE; ?></p>
      </footer>

    </div> <!-- /container -->

    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>   
  </body>
</html>
<?php
}

function boiteAlerte($texte, $ico = true) {
?>
  <div class="alert alert-danger fade in">
<?php
    if($ico) echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
    echo $texte; 
?>
  </div>
<?php
}

function boiteSucces($texte, $ico = true) {
?>
  <div class="alert alert-success fade in">
<?php
    if($ico) echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
    echo $texte; 
?>
  </div>
<?php
}

function boiteInfo($texte, $ico = true) {
?>
  <div class="alert alert-info fade in">
<?php
    if($ico) echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
    echo $texte; 
?>
  </div>
<?php
}

function progressBar($min, $max, $courant) {
	$pas = (int)(100 / ($max - $min + 1));
	$fait = $courant * $pas;
	$encours = $pas;
	$afaire = 100 - $fait - $encours;
?>
<div class="progress progress-striped active">
  <div class="progress-bar progress-bar-success" style="width: <?php echo $fait;?>%"><span class="sr-only">Fait : <?php echo $fait; ?>%</span></div>
  <div class="progress-bar progress-bar-warning" style="width: <?php echo $encours;?>%"><span class="sr-only">Courant</span></div>
  <div class="progress-bar progress-bar-danger" style="width: <?php echo $afaire;?>%"><span class='sr-only'>Reste : <?php echo $afaire; ?>%</span></div>
</div>	
<?php
}

?>
