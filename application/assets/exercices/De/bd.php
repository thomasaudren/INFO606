<?php

// Constantes
define("BD_UTILISATEURS", "utilisateurs"); // Les utilisateurs

if(!defined("SQL_LAYER")) {

define("SQL_LAYER","mysql");

class sql_db {

	// *********
	// Attributs
	// *********

	var $db_connect_id;
	var $query_result;
	var $row = array();
	var $rowset = array();
	var $num_queries = 0;

	// *************
	// Constructeurs
	// *************
	function mysql_escape_string($param){
		return mysql_real_escape_string($param, $this->db_connect_id);
	}
	//
	// Cr�e une connexion vers la base de donn�es
	// param�tre sqlserveur : le serveur SQL
	// param�tre sqluser : le nom d'utilisateur
	// param�tre sqlpassword : le mot de passe utilisateur
	// param�tre database : le nom de la base
	// param�tre persistency : cr�e une connexion persistante sur le serveur (VRAI par d�faut)
	// retourne FALSE en cas d'erreur
	//
	function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true) {
		$this->persistency = $persistency;
		$this->user = $sqluser;
		$this->password = $sqlpassword;
		$this->server = $sqlserver;
		$this->dbname = $database;

		if($this->persistency) {
			$this->db_connect_id = @mysql_pconnect($this->server, $this->user, $this->password);
		}
		else {
			$this->db_connect_id = @mysql_connect($this->server, $this->user, $this->password);
		}
		if($this->db_connect_id) {
			if($database != "") {
				$this->dbname = $database;
				$dbselect = @mysql_select_db($this->dbname);
				if(!$dbselect) {
					@mysql_close($this->db_connect_id);
					$this->db_connect_id = $dbselect;
				}
			}
			return $this->db_connect_id;
		}
		else {
			return false;
		}
	}

	// ***************
	// Autres m�thodes
	// ***************

	//
	// Ferme la connexion � la base de donn�es
	// retourne le r�sultat ou FALSE en cas d'�chec
	//
	function sql_close() {
		if($this->db_connect_id) {
			if($this->query_result) {
				@mysql_free_result($this->query_result);
			}
			$result = @mysql_close($this->db_connect_id);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Ex�cute une requ�te et retourne le r�sultat
	// param�tre query : requ�te � ex�cuter
	// param�tre transaction : ???
	// retourne le r�sultat ou FALSE en cas d'erreur
	//
	function sql_query($query = "", $transaction = FALSE) {
		
		// Supprime toutes les requ�te pr�-existantes
		unset($this->query_result);
		if($query != "") {
			$this->query_result = @mysql_query($query, $this->db_connect_id);
			if (!$this->query_result) die('Requ�te invalide : ' . $query. " -- ".mysql_error());
		}
		if($this->query_result) {
			unset($this->row[$this->query_result]);
			unset($this->rowset[$this->query_result]);
			return $this->query_result;
		}
		else {
			return ( $transaction == END_TRANSACTION ) ? true : false;
		}
	}

	//
	// Retourne le nombre de lignes dans la derni�re requ�te
	// retourne le nombre de lignes ou FALSE en cas d'erreur
	//
	function sql_numrows($query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = @mysql_num_rows($query_id);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Retourne le nombre de lignes qui ont �t� affect�e lors de la derni�re requ�te SQL
	// retourne le nombre de lignes ou FALSE en cas d'erreur
	//
	function sql_affectedrows() {
		if($this->db_connect_id) {
			$result = @mysql_affected_rows($this->db_connect_id);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Retourne le nombre de champs dans le r�sultat de la derni�re requ�te
	// retourne le nombre de champs ou FALSE en cas d'erreur
	//
	function sql_numfields($query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = @mysql_num_fields($query_id);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Retourne le nom d'une colonne dans le r�sultat de la derni�re requ�te
	// param�tre offset : num�ro de colonne
	// retourne le nom de la colonne ou FALSE en cas d'erreur
	//
	function sql_fieldname($offset, $query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = @mysql_field_name($query_id, $offset);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Retourne le type d'une colonne dans le r�sultat de la derni�re requ�te
	// param�tre offset : num�ro de colonne
	// retourne le type ou FALSE en cas d'erreur
	//
	function sql_fieldtype($offset, $query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = @mysql_field_type($query_id, $offset);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Retourne le r�sultat d'une requ�te SQL sous la forme d'un tableau associatif
	// retourne le tableau ou FALSE en cas d'erreur
	//
	function sql_fetchrow($query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$this->row[$query_id] = @mysql_fetch_array($query_id);
			return $this->row[$query_id];
		}
		else {
			return false;
		}
	}

	//
	// ??? J'ai l'impression que c'est un mysql_fetch_assoc !!!
	//
	function sql_fetchrowset($query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			unset($this->rowset[$query_id]);
			unset($this->row[$query_id]);
			while($this->rowset[$query_id] = @mysql_fetch_array($query_id)) {
				$result[] = $this->rowset[$query_id];
			}
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// ???
	//
	function sql_fetchfield($field, $rownum = -1, $query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			if($rownum > -1) {
				$result = @mysql_result($query_id, $rownum, $field);
			}
			else {
				if(empty($this->row[$query_id]) && empty($this->rowset[$query_id])) {
					if($this->sql_fetchrow()) {
						$result = $this->row[$query_id][$field];
					}
				}
				else {
					if($this->rowset[$query_id]) {
						$result = $this->rowset[$query_id][$field];
					}
					else if($this->row[$query_id]) {
						$result = $this->row[$query_id][$field];
					}
				}
			}
			return $result;
		}
		else {
			return false;
		}
	}

	// 
	// D�place le pointeur interne de r�sultat. Il le fait pointer � la ligne row_number.
	// Le prochain appel � une fonction MySQL de r�cup�ration de donn�es, comme la fonction mysql_fetch_assoc(), retournera cette ligne. 
	// param�tre rownum : num�ro de la ligne
	// retourne FALSE en cas d'erreur
	// 
	function sql_rowseek($rownum, $query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}
		if($query_id) {
			$result = @mysql_data_seek($query_id, $rownum);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Retourne le dernier identifiant g�n�r� par un champ de type AUTO_INCREMENT,
	// retourne la valeur du dernier identifiant ou FALSE en cas d'erreur
	//
	function sql_nextid(){
		if($this->db_connect_id) {
			$result = @mysql_insert_id($this->db_connect_id);
			return $result;
		}
		else {
			return false;
		}
	}

	//
	// Lib�re le r�sultat de la m�moire (pour �viter d'utiliser trop de m�moire pendant le script)
	// param�tre query_id : identifiant de la requ�te
	// retourne TRUE en cas de r�ussite ou FALSE en cas d'�chec
	//
	function sql_freeresult($query_id = 0) {
		if(!$query_id) {
			$query_id = $this->query_result;
		}

		if ($query_id) {
			unset($this->row[$query_id]);
			unset($this->rowset[$query_id]);

			@mysql_free_result($query_id);

			return true;
		}
		else {
			return false;
		}
	}

	//
	// R�cup�re le code d'erreur de la derni�re requ�te
	// param�tre query_id : identifiant de la requ�te
	// retourne le code d'erreur
	//
	function sql_error($query_id = 0) {
		$result["message"] = @mysql_error($this->db_connect_id);
		$result["code"] = @mysql_errno($this->db_connect_id);

		return $result;
	}

} // class sql_db

global $db;
//$db = new sql_db("localhost","root", "root", "jeu", false);
$db = new sql_db("localhost","root", "root", "606", false);

if(!$db->db_connect_id) {
	//echo "<div class=\"error\">Site en maintenance pour quelques minutes.</div><br><br>";
	//die();		
}

} // if ... define

?>
