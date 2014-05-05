<?php

include "connexion.php";

class utilsM
{
	
	public function __construct()
	{
	}

	private function getMimeType($filename) 
	{
	  $ext = strtolower(substr($filename, strrpos($filename, '.')));
	  switch ($ext)
	    {
	    case '.jpeg':
	    case '.jpg':
	      $mimetype = 'image/jpeg';
	    break;
	    case '.gif':
	      $mimetype = 'image/gif';
	    break;
	    case '.png':
	      $mimetype = 'image/png';
	    break;
	    case '.txt':
	      $mimetype = 'text/plain';
	    break;
	    case '.html':
	    case '.htm':
	      $mimetype = 'text/html';
	    break;
	    default:
	      $mimetype = 'application/octet-stream';
	    }
	  return $mimetype;
	}

	public function ImageToBase64($img_file)
	{
		// Transforme l'image en base 64
		$imgData = base64_encode(file_get_contents($img_file));

		//Mimetype de l'image
		$mimeType = $this->getMimeType($img_file);
		
		$res = 'data:'.$mimeType.';base64,'.$imgData;

		return $res;
	}

	function unzip($file, $dest)
	{
		$zip = new ZipArchive();
		if ($zip->open($file) !== true) 
		{
			return 'Impossible d\'ouvrir l\'archive';
		}

		$zip->extractTo($dest);
	    $zip->close();
	    unlink($file);    
	}


	public function init($nomExercice, $niveau, $matiere, $exercice, $idCrea)
	{
		$exerciceC = new exerciceC();

		/* Création du fichier init + ajout dans la base */
		$nomExercice = $_POST["nomExercice"];
		/*$createur = $_POST["createur"];*/
		$niveau = $_POST["niveau"];
		$matiere = $_POST["matiere"];
		$nomExercice = $_POST["nomExercice"];

		$exercice = $_FILES['exercice'];

		// si le fichier a bien été uploadé
		if ($exercice['error'] > 0) $erreur = "Erreur lors du transfert";

		/*
		if ($exercice['size'] > 1000) $erreur = "Le fichier est trop gros";
		*/

		$extensions_valides = array( 'zip' , 'rar');
		$extension_upload = strtolower(  substr(  strrchr($exercice['name'], '.')  ,1)  );
		if ( !in_array($extension_upload,$extensions_valides) ) 
		{
			die("Extension invalide. Les extensions valides sont : zip et rar");
		}

		$time = date('l jS \of F Y h:i:s A');

		if(!@mkdir("application/assets/exercices/".$nomExercice))
		{
			$error = utf8_decode("Problème lors de la création du répértoire, le nom de l'exercice est peut être déjà prit. Veuillez contactez un administrateur si l'erreur persiste.");
			die($error);
		}
			
			$this->unzip($exercice['tmp_name'], "application/assets/exercices/".$nomExercice);
			
			$fichier="init.json";
			$json["nom"] = $nomExercice;
			$json["matiere"] = $matiere;
			$json["niveau"] = $niveau;
			/*$json["createur"] = $createur;*/
			$json["date"] = $time;

			if($pointeur=fopen("application/assets/exercices/".$nomExercice."/".$fichier,'w+'))
				{
					if(!fwrite($pointeur, json_encode($json)))
					{
						$error = utf8_decode("Problème d'écriture du fichier init, veuillez contactez un administrateur");
						die($error);
					}
				}
			else
				{
					$error = utf8_decode("Problème d'ouverture du fichier, veuillez contactez un administrateur.");
					die($error);	
				}
			fclose($pointeur);

		$exerciceC->ajoutExercice($nomExercice, $idCrea, $niveau, $matiere);
	}

}