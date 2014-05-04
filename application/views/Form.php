<?php

$matiereC = new matiereC();
$niveauC = new niveauC();
$matieres = $matiereC->getMatieres();
$niveaux = $niveauC->getNiveaux();
?>

<style>
.fileUpload {
	position: relative;
	overflow: hidden;
	margin: 10px;
}
.fileUpload input.upload {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
</style>
<div align="center">
	<form class='well' role='form' style='text-align:center;width:500px;' action="init" method='POST' enctype="multipart/form-data">
		<p class="bg-primary">Intitulé de l'exercice</p><input type='text' class="form-control" placeholder="Nom de l'exercice" name='nomExercice' /><br>
		<p class="bg-primary">Auteur</p><input type='text' class="form-control" placeholder='<?php echo ucfirst($_SESSION['prenom'])." ".ucfirst($_SESSION['nom']); ?>' name='createur' disabled/><br>
		<p class="bg-primary">Matière</p><select class="selectpicker form-control" name="matiere">
    		<?php
    			$i=0;
    			$options="";
    			while($i< sizeof($matieres))
    			{
    				$options.="<option value='".$matieres[$i]['id']."'>".$matieres[$i]['lib']."</option>";
    				$i++;
    			}
    			echo $options;
    		?>
  		</select><br>

		<p class="bg-primary">Niveau</p><select class="selectpicker form-control" name="niveau">
    		<?php
    			$i=0;
    			$options="";
    			while($i< sizeof($niveaux))
    			{
    				$options.="<option value='".$niveaux[$i]['id']."'>".$niveaux[$i]['lib']."</option>";
    				$i++;
    			}
    			echo $options;
    		?>
  		</select>
		<div class="fileUpload btn btn-primary">
		    <span>Choisissez un fichier</span>
		    <input type="file" name="exercice" id="uploadBtn" class="upload" />
		</div><br>
		<input id="uploadFile" class="form-control" placeholder="Fichier" disabled="disabled"/><br>
		<input class='btn' type='submit' value='Envoyer' />
	</form>
</div>
<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
	document.getElementById("uploadFile").value = this.value.replace("C:\\fakepath\\", "");
};
</script>