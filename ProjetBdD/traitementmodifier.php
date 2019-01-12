<?php 
	define( 'DB_NAME', 'Livres' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
	
	if(isset($_POST['modifier'])){
		print_r($_POST);
		$table = $_POST['table'];
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
		switch($table){
			
			case "auteur":
			$req = $connexion->prepare("UPDATE `auteur` SET `id_auteur`=:new_id,`nom_auteur` = :nom, `prénom_auteur` = :prenom, `naissance` = :naissance, `décès` = :deces, `nationalité` = :nationalite WHERE `auteur`.`id_auteur` = :id" );
			$req->execute(array(
					'new_id' => htmlspecialchars($_POST[0]),
					'id' => htmlspecialchars($_POST["invisible0"]),
					'nom' => htmlspecialchars($_POST[1]),
					'prenom' => htmlspecialchars($_POST[2]),
					'naissance'=> htmlspecialchars($_POST[3]),
					'deces'=> htmlspecialchars($_POST[4]),
					'nationalite'=> htmlspecialchars($_POST[5])));	
					break; 
			case "editeur":
				$req = $connexion->prepare("UPDATE `editeur` SET `id_editeur`=:new_id,`nom_éditeur` = :nom_editeur , `site_web` = :site_web WHERE `editeur`.`id_editeur` = :id_editeur");

				$req->execute(array(
				'new_id' => htmlspecialchars($_POST[0]),
				'id_editeur' => htmlspecialchars($_POST["invisible0"]),
				'nom_editeur' => htmlspecialchars($_POST[1]),
				'site_web' => htmlspecialchars($_POST[2]))); 
				break; 
			case "livre":
			$req = $connexion->prepare("UPDATE `livre` SET `id_livre`=:new_id, `titre_livre` = :titre_livre , `genre` = :genre ,`parution` = :parution ,`nature` = :nature ,`langue` = :langue WHERE `livre`.`id_livre` = :id_livre");
				$req->execute(array(
					'new_id' => htmlspecialchars($_POST[0]),
					'id_livre' => htmlspecialchars($_POST["invisible0"]),
					'titre_livre' => htmlspecialchars($_POST[1]),
					'genre' => htmlspecialchars($_POST[2]),
					'parution' => htmlspecialchars($_POST[3]),
					'nature' => htmlspecialchars($_POST[4]),
					'langue' => htmlspecialchars($_POST[5])));
				break; 
			case "ecriture":
			$req = $connexion->prepare("UPDATE `ecriture` SET `id_auteur`=:new_id_auteur, `id_livre` = :new_id_livre WHERE `ecriture`.`id_auteur` = :id_auteur and `ecriture`.`id_livre` = :id_livre");
				$req->execute(array(
					'new_id_auteur' => htmlspecialchars($_POST[0]),
					'new_id_livre' => htmlspecialchars($_POST[1]),
					'id_auteur' => htmlspecialchars($_POST["invisible0"]),
					'id_livre' => htmlspecialchars($_POST["invisible1"])));
				break; 
			case "edition":
			$req = $connexion->prepare("UPDATE `edition` SET `id_editeur`=:new_id_editeur, `id_livre` = :new_id_livre WHERE `edition`.`id_editeur` = :id_editeur and `edition`.`id_livre` = :id_livre");
				$req->execute(array(
					'new_id_editeur' => htmlspecialchars($_POST[0]),
					'new_id_livre' => htmlspecialchars($_POST[1]),
					'id_editeur' => htmlspecialchars($_POST["invisible0"]),
					'id_livre' => htmlspecialchars($_POST["invisible1"])));
				break; 
			
		}
		
	}else if(isset($_POST['supprimer'])){
		print_r($_POST);
		$table = $_POST['table'];
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
		switch($table){
			
			case "auteur":
			$req = $connexion->prepare("DELETE FROM `auteur` WHERE `auteur`.`id_auteur` = :id" );
			$req->execute(array(
				'id' => $_POST[0]));
					break; 
			case "editeur":
				$req = $connexion->prepare("DELETE FROM `editeur` WHERE `editeur`.`id_editeur` = :id_editeur");

				$req->execute(array(
				'id_editeur' => $_POST[0])); 
				break; 
			case "livre":
			$req = $connexion->prepare("DELETE FROM  `livre` WHERE `livre`.`id_livre` = :id_livre");
				$req->execute(array(
				'id_livre' => $_POST[0])); 
				break; 
			case "edition":
			$req = $connexion->prepare("DELETE FROM  `edition` WHERE `edition`.`id_editeur` = :id_editeur and `edition`.`id_livre` = :id_livre");
				$req->execute(array(
				'id_editeur' => htmlspecialchars($_POST["invisible0"]),
				'id_livre' => htmlspecialchars($_POST["invisible1"]))); 
				break; 
			case "ecriture":
				$req = $connexion->prepare("DELETE FROM  `ecriture` WHERE `ecriture`.`id_auteur` = :id_auteur and `ecriture`.`id_livre` = :id_livre");
				$req->execute(array(
				'id_auteur' => htmlspecialchars($_POST["invisible0"]),
				'id_livre' => htmlspecialchars($_POST["invisible1"]))); 
				break; 
		}
	}

header('Location: formulairemodif.php');

?>