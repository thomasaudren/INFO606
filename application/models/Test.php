<?php 

include "paysM.php";

ini_set('display_errors', 1);

$m = new paysM();
try{
	$m->creerPays("France");
} 
catch (PDOException $e) {
echo"<pre>";
    echo 'Échec : ' . $e->getMessage();
var_dump($e);
echo"</pre>";
}
print_r($m->rechercher("France"));