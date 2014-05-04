<?php

include "/application/models/utilsM.php";

class utilsC
{	
	private $utils;

	public function __construct()
	{
		$this->utils= new utilsM;
	}

	public function ImageToBase64($img_file)
	{
		return $this->utils->ImageToBase64($img_file);
	}
}


