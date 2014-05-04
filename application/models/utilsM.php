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
		
		//$img_file = base_url().'application/assets/img/icons/Stats.png';

		// Transforme l'image en base 64
		$imgData = base64_encode(file_get_contents($img_file));

		//Mimetype de l'image
		$mimeType = $this->getMimeType($img_file);
		
		$res = 'data:'.$mimeType.';base64,'.$imgData;

		return $res;
	}

}