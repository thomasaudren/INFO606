<?php
include "connexion.php";

$classeC = new classeC();

echo $classeC->generateLibClasseByDefault("1", "1");
?>