<?php 

include "eleveM.php";

ini_set('display_errors', 1);

$m = new eleveM();
try{
	$m->recupElevesByProf(2);
} 
catch (PDOException $e) {
echo"<pre>";
    echo 'Échec : ' . $e->getMessage();
var_dump($e);
echo"</pre>";
}
