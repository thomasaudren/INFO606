<?php

// Classe correspondant à une transaction
class Transaction {

	// Gestion de la navigation (retour en arrière, rechargement)
	static function check() {
		$result = true;		
		if(isset($_SESSION['lastTransaction'])) {
			if(isset($_POST['idTransaction'])) {
				if($_SESSION['lastTransaction'] != $_POST['idTransaction']) {
					// Erreur de transaction
					$result = false;
				}
			}
			else {
				// Transaction donnée mais rien dans le formulaire
				$result = false;
			}
		}
		else {
			$result = false;
		}
		$_SESSION['lastTransaction'] = Transaction::generate();
		
		return $result;
	}
	
	// Génération d'un numéro de transaction unique
	static function generate() {
		return uniqid();
	}
	
	// Insère un champ pour la transaction
	static function input() {
		echo "<input type=\"hidden\" name=\"idTransaction\" value=\"".$_SESSION['lastTransaction']."\"/>\n";
	}

} // class Transaction

?>