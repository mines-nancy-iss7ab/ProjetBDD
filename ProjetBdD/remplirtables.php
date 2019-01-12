<?php

// Connexion à la base de données
 
	define( 'DB_NAME', 'Livres' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Projet BDD</title>
	</head>
	
	<body>
	<div class="container">
	<form method="post">
	
	<label>Auteur</label> <input type="file" name="table_auteur" required/><br/>
	<label>Editeur</label> <input type="file" name="table_editeur"required/><br/>
	<label>Livre</label> <input type="file" name="table_livre"required/><br/>
	<label>Ecrit par</label> <input type="file" name="table_ecriture" required/><br/>
	<label>Edité par</label> <input type="file" name="table_edition" required/><br/><br/>
	<input type="submit" name="commencer_remplir" value="Remplir table"/>
	</form>
	</div>
	
	<?php 
	if(isset($_POST['commencer_remplir'])){
		if(isset($_POST['table_auteur'])){
			
				insererAuteur($_POST['table_auteur']);
				
			}
		
		if(isset($_POST['table_editeur'])){
			
			insererEditeur($_POST['table_editeur']);
				
			}
		
		if(isset($_POST['table_livre'])){
			
			insererLivre($_POST['table_livre']);
				
			}
		
		if(isset($_POST['table_ecriture'])){
			//$handler = fopen($_POST['table_ecriture'],"r");
			
			insererEditePar($_POST['table_ecriture']);
			
			}
		
		if(isset($_POST['table_edition'])){
			//$handler = fopen($_POST['table_edition'],"r");
			
			insererEcritPar($_POST['table_edition']);
			
			}
		
		header('Location: index.php');
	}
	
	function insererEditeur($file){
			$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD,array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true));
			//$req = $connexion->prepare('INSERT ignore INTO editeur(nom_éditeur,site_web) VALUES(:nom_editeur, :siteweb)');
			$req = $connexion->prepare("LOAD DATA LOCAL INFILE :filename into table editeur FIELDS TERMINATED BY ';' ENCLOSED BY '\"' IGNORE 1 LINES");

			/*$req->execute(array(
				'filename'=>$file,
				'nom_editeur' => $nom,
				'siteweb' => $site));*/
				
			$req->execute(array(
				'filename'=>$file)); 
	}
	
	function insererAuteur($file){
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD,array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true));
		$req = $connexion->prepare("LOAD DATA LOCAL INFILE :filename into table auteur FIELDS TERMINATED BY ';' ENCLOSED BY '\"' IGNORE 1 LINES");
		$req->execute(array(
				'filename'=>$file)); 	
	}
	
	function insererLivre($file){
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD,array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true));
				$req = $connexion->prepare("LOAD DATA LOCAL INFILE :filename into table livre FIELDS TERMINATED BY ';' ENCLOSED BY '\"' IGNORE 1 LINES");

				$req->execute(array(
				'filename'=>$file)); 
	}
	function insererEditePar($file){
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD,array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true));
		$req = $connexion->prepare("LOAD DATA LOCAL INFILE :filename into table edition FIELDS TERMINATED BY ';' ENCLOSED BY '\"' IGNORE 1 LINES");

		$req->execute(array(
				'filename'=>$file)); 
	}
	function insererEcritPar($file){
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD,array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true));
		$req = $connexion->prepare("LOAD DATA LOCAL INFILE :filename into table ecriture FIELDS TERMINATED BY ';' ENCLOSED BY '\"' IGNORE 1 LINES");

		$req->execute(array(
				'filename'=>$file)); 
	}
	
	?>
	
	</body>
</html>