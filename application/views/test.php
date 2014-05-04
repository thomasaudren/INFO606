<?php
include "connexion.php";

$classeC = new classeC();


// A few settings
$img_file = base_url().'application/assets/img/icons/Stats.png';

// Read image path, convert to base64 encoding

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data:image/png;base64,'.$imgData;

// Echo out a sample image
echo '<img src="',$src,'">';
?>