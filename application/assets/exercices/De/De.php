<?php

define("NB_LANCERS", 10);

// Classe correspondant au jeu de dés
class De {

	public $max;       // Valeur max. pour les dés
	public $nb;        // Nombre de dés pour le jeu
	public $nbLancers; // Nombre de lancers
	public $jeu;       // Les différents tirages
	public $courant;   // Tirage actuel
	public $reponses;  // Réponses
	public $bons;      // Bonnes réponses

	// Création d'un utilisateur
	function De($max, $nb, $nbLancers, $genere = true) {
		$this->max = $max;
		$this->nb = $nb;
		$this->courant = 0;
		$this->nbLancers = $nbLancers;
		$this->jeu = array();
		$this->reponses = array();
		$this->bons = 0;
		if($genere)
			$this->genereJeu();
	}

	// Indique si le jeu est terminé
	function estFini() {
		return ($this->courant == $this->nbLancers);
	} 
	
	// Récupère le nombre de bonnes réponses
	function getBonnnesReponses() {
		return $this->bons;
	}

	// Génère un tirage
	function genereJeu() {
		for($j = 0; $j < $this->nbLancers; $j++) {	
			$tirage = array();
			for($i = 0; $i < $this->nb; $i++) {
				$val = rand(1, $this->max);
				array_push($tirage, $val);
			}
			array_push($this->jeu, $tirage);
		}
	}

	// Affiche le tirage courant
	function afficheTirageCourant() {
		for($i = 0; $i < sizeof($this->jeu[$this->courant]); $i++) {
			De::afficheDe($this->jeu[$this->courant][$i]);
			echo "&nbsp;&nbsp;&nbsp;";
		}		
	}

	// Affiche le tirage spécifié
	function afficheTirage($num) {
		for($i = 0; $i < sizeof($this->jeu[$num]); $i++) {
			De::afficheDe($this->jeu[$num][$i]);
			echo "&nbsp;&nbsp;&nbsp;";
		}		
	}
		
	// Affiche les dés
	static function afficheDe($val) {
		echo "<img width=\"100px\" src=\"images/$val.png\" />";
	}
	
	// Affiche les boutons
	function afficheBoutons() {
		?>
		<input type="hidden" name="valeurDe" id="valeurDe" value=""\>
		<?php
		for($i = $this->nb; $i <= $this->nb*$this->max; $i++) {
			echo "<button class=\"btn btn-primary\" type=\"submit\" onclick=\"document.getElementById('valeurDe').value=$i;\">$i</button>\n";
		}		
	}
	
	// Récupère la réponse et passe à la question suivante
	function recupereReponse() {
		if(isset($_POST['valeurDe'])) {
			$valeur = intval($_POST['valeurDe']);			
			array_push($this->reponses, $valeur);
			if($valeur == array_sum($this->jeu[$this->courant])) $this->bons++;
		}		
		$this->courant++;
	}
	
	// Affiche récapitulatif
	function afficheRecapitulatif() {
		for($i = 0; $i < $this->nbLancers; $i++) {
			echo "<p><center>";
			$this->afficheTirage($i);
			echo "<span class=\"label label-info\">Tu as saisi : ".$this->reponses[$i]."</span>";
			if($this->reponses[$i] == array_sum($this->jeu[$i])) {
				echo "<span class=\"label label-success\">";				
				echo "&nbsp;&nbsp;Bravo !!!&nbsp;&nbsp;";				
				echo "</span>";
			}
			else {
				echo "<span class=\"label label-danger\">";
				echo "&nbsp;&nbsp;Erreur !!! Il fallait saisir ".array_sum($this->jeu[$i])."&nbsp;&nbsp;";				
				echo "</span>";
			}
			echo "</center></p>";
		}
	}
	
	// Exporte le jeu sous la forme d'une chaîne de caractères
	function toString() {
		$str = $this->max."_".$this->nb."_".$this->nbLancers;
		
		for($i = 0; $i < NB_LANCERS; $i++) {
			$str .= "_";
			for($j = 0; $j < $this->nb; $j++)
				$str .= $this->jeu[$i][$j]."_";
			$str .= array_sum($this->jeu[$i])."_";
			$str .= $this->reponses[$i];	
		}
		
		return $str;
	}
	
	// Convertit une chaîne de caractère en jeu
	static function fromString($str) {
		$array = explode("_", $str);
		$de = new De($array[0], $array[1], $array[2], false);
		$k = 3;
		for($i = 0; $i < $array[2]; $i++) {
			$tirage = array();
			for($j = 0; $j < $de->nb; $j++) {
				array_push($tirage, $array[$k]);
				$k++;
			}
			array_push($de->jeu, $tirage);
			$k++;
			array_push($de->reponses, $array[$k]);
			$k++;
		}
		
		return $de;
	}

} // class Utilisateur

?>