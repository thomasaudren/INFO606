<?php 

include "exerciceM.php";

ini_set('display_errors', 1);

$m = new exerciceM();
try{
	$m->ajoutExercice("France", "1", "1", "1");
} 
catch (PDOException $e) {
echo"<pre>";
    echo 'Échec : ' . $e->getMessage();
var_dump($e);
echo"</pre>";
}
