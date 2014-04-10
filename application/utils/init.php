<?php
echo"entre";
/* Création du fichier init */
$nomExercice = $_POST["nomExercice"];
$createur = $_POST["createur"];
$langue = $_POST["langue"];
$niveau = $_POST["niveau"];
$matiere = $_POST["matiere"];
$nomExercice = $_POST["nomExercice"];

$exercice = $_FILES['exercice'];

// si le fichier a bien été uploadé
if ($exercice['error'] > 0) $erreur = "Erreur lors du transfert";

/*
if ($exercice['size'] > 1000) $erreur = "Le fichier est trop gros";
*/

echo"ouou";
$extensions_valides = array( 'zip' , 'rar','pdf');
$extension_upload = strtolower(  substr(  strrchr($exercice['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";



$time = date('l jS \of F Y h:i:s A');

if(!mkdir($nomExercice))
{
	echo"Problème lors de la création du répértoire, veuillez contactez un administrateur.";
}


echo"ici";
$fichier="init.json";
if(file_exists("/".$nomExercice."/".$fichier))
{
  echo"Problème lors de la création du fichier, veuillez contactez un administrateur.";
}
else
{
	touch("Test/".$fichier);
}
	echo"la";
	
	$json["nom"] = $nomExercice;
	$json["matiere"] = $matiere;
	$json["niveau"] = $niveau;
	$json["createur"] = $createur;
	$json["langue"] = $langue;
	$json["date"] = $time;

if($dir= opendir("/Test"))
{	
	echo "\nOK\n";
	if($pointeur=fopen($fichier,'w+'))
		{
			echo"arrive a lire";
			if(fwrite($pointeur, json_encode($json)))
			{
				echo"arrive a ecrire";
			}
			else{
				echo"erreur ecriture";
			}
		}
	else
		{
			echo"Problème d'ouverture du fichier, veuillez contactez un administrateur.";	
		}
	fclose($pointeur);
}
else echo "\nCa ne fonctionne pas \n";