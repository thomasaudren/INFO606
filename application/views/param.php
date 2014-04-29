<?php


$data['title'] = 'Paramètre';
$this->load->view('template/header', $data);
?>

<a style='margin-left:2%;margin-top:-4%' type='button' class='btn btn-danger' href="/INFO606/welcome/redirect">Retour</a>

<div id='content' style='margin-left:10%'>
	<div class='rowOne'>
		<div class='well' style='width:90%;height:25%'>
			<img style='float:left;margin-top:0.5%;padding-right:1%' src=<?php echo base_url().'application/assets/img/icons/Ajout.png' ?> />
			<form>
				<input style='width:20%' class='form-control' type="text" placeholder="Nom de l'élève"></input>
				<input style='width:20%' class='form-control' type="text" placeholder="Prénom de l'élève"></input>
				<input style='width:20%' class='form-control' type="text" placeholder="Date de naissance"></input>
				<input style='width:20%' class='form-control' type="text" placeholder="Classe"></input>
				<input style='margin-left:7%' type='submit' class='btn btn-success' value='Ajouter' />
			</form>
		</div>
	</div>
</div>

