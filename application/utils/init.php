<?php

/* Création du fichier init */

$nomExercice = $_POST["nomExercice"];
$createur = $_POST["createur"];
$langue = $_POST["langue"];
$niveau = $_POST["niveau"];
$matiere = $_POST["matiere"];

$time = date('l jS \of F Y h:i:s A');

if(!mkdir($nomExercice))
{
	die("Problème lors de la création du répértoire, veuillez contactez un administrateur.");
}

$fichier="init.json";
if(file_exists(/$nomExercice/$fichier))
{
  die("Problème lors de la création du fichier, veuillez contactez un administrateur.");
}
else
{
	touch(/$nomExercice/$fichier);
}

$json["nom"] = $nomExercice;
$json["matiere"] = $matiere;
$json["niveau"] = $niveau;
$json["createur"] = $createur;
$json["langue"] = $langue;
$json["date"] = $time;

if($pointeur=fopen($fichier,'w'))
{
	fwrite($pointeur, json_encode($json));
}
else
{
	die("Problème d'ouverture du fichier, veuillez contactez un administrateur.");	
}

fclose($pointeur);