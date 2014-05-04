<?php

$personneC = new personneC();
$niveauC = new niveauC();
$data['title'] = 'Paramètre';
$this->load->view('template/header', $data);
?>

<a style='margin-left:2%;margin-top:-4%' type='button' class='btn btn-danger' href="/INFO606/welcome/redirect">Retour</a>

<div id='content' style='margin-left:10%'>
	<div class='rowOne'>

		<div class='well' style='width:90%;height:100%'>
			<img style='margin-left:45%;padding-bottom:2%' src=<?php echo base_url().'application/assets/img/icons/Ajout.png' ?> />
			<form action='addStudent' method='POST'>
				<p class="bg-primary">Nom de l'élève</p><input class='form-control' type="text" placeholder="Nom de l'élève" name='nom' required></input><br>
				<p class="bg-primary">Prénom de l'élève</p><input class='form-control' type="text" placeholder="Prénom de l'élève" name='prenom' required></input><br>
				<p class="bg-primary">Date de naissance</p><input class='form-control' type="date" placeholder="Date de naissance" name='birthday' required></input><br>
				<p class="bg-primary">Etablissement</p><select class="selectpicker form-control" name="eta" id="eta" required>
				<?php
					$i=0;
					$options="<option></option>";
					$eta = $personneC->getEtablissementByIdPersonne($_SESSION['id']);
					while($i< sizeof($eta))
	    			{
	    				$options.="<option value='".$eta[$i]['id']."'>".$eta[$i]['lib']."</option>";
	    				$i++;
	    			}
	    			echo $options;
				?>
				</select><br>
				<p class="bg-primary">Classe</p><select class="selectpicker form-control" id="classes" name="classe" disabled required>
  				</select><br>
				<input style='margin-left:45%' type='submit' class='btn btn-success' value='Ajouter' />
			</form>
		</div>

	</div>

	<div class='rowTwo'>

		<div class='well' style='width:90%;height:45%'>
			<!--<img style='margin-left:45%;padding-bottom:2%' src=<?php //echo base_url().'application/assets/img/icons/Ajout.png' ?> />-->
			<form action='addClasse' method='POST'>
				<p class="bg-primary">Etablissement</p><select class="selectpicker form-control" name="eta" required>
				<?php
					$i=0;
					$options="";
					$eta = $personneC->getEtablissementByIdPersonne($_SESSION['id']);
					while($i< sizeof($eta))
	    			{
	    				$options.="<option value='".$eta[$i]['id']."'>".$eta[$i]['lib']."</option>";
	    				$i++;
	    			}
	    			echo $options;
				?>
				</select><br>
				<p class="bg-primary">Niveau</p><select class="selectpicker form-control" name="niveau" required>
		    	<?php
		    			$i=0;
		    			$options="";
		    			$niveaux = $niveauC->getNiveaux();
		    			while($i< sizeof($niveaux))
		    			{
		    				$options.="<option value='".$niveaux[$i]['id']."'>".$niveaux[$i]['lib']."</option>";
		    				$i++;
		    			}
		    			echo $options;
		    		?>
		  		</select><br>
				<p class="bg-primary">Nom de la classe*</p><input class='form-control' type="text" placeholder="Libellé" name='lib'></input><br>
				<p><sub><i>*Le nom par défaut sera le nom du niveau suivi d'un numéro (ex : CM1-1)</i></sub></p>
				<input style='margin-left:45%' type='submit' class='btn btn-success' value='Ajouter' />
			</form>
		</div>

	</div>

</div>

<script type="text/javascript">
$(function(){
	$('#eta').change(function(){
		var id = $('#eta').val();
		$.ajax({url:"getClasses",type:"POST",data:{id:id}}).done(function(html)
		{
			$('#classes').prop("disabled", false);
			$("#classes").html(html);
		});
	});
});
</script>
