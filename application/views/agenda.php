<a style='margin-left:2%;margin-top:-4%' type='button' class='btn btn-danger' href="/INFO606/welcome/redirect">Retour</a>


<?php
if($_SESSION['profil']=="Professeur")
{
	$form="<div align='right' style='margin-right:3%;margin-top:-3%'><form style='text-align:center;width:500px;'>";
	$form.="<p class='bg-primary'>Note</p><textarea  style='height:150px;' class='form-control'></textarea><br>";
	$form.="<p class='bg-primary'>Exercice à réaliser</p><textarea class='form-control'></textarea><br>";
	$form.="<input class='btn btn-success' type='submit' value='Envoyer' /></form></div>";
	echo $form;
}

?>

<div style='margin-top:-15%;'>
<table border="2" id="grid">
	<tr><td>efefe
	<tr><td>efefef
</table>
</div>

<script type="text/javascript" src="<?php echo base_url().'application/assets/js/jquery.jqGrid.js'?>"></script>
<script type="text/javascript">
	jQuery(".grid").jqGrid(options);
</script>