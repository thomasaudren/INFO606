<?php
/*Class principale*/

class Jeu
{
	/*Non définitif*/
	function init($nom){
		echo "init: ".$nom;
	}

	/*Permet le replay*/
	function replay(){
		echo "<div id='replay'>Pas replay disponible<div>";
	}
}
