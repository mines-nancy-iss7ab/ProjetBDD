<?php

// Connexion à la base de données
 
	define( 'DB_NAME', 'Livres' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
	

	function CreateBase(){
		// connexion à Mysql sans base de données
		$pdo = new PDO('mysql:host='.DB_HOST.";charset=utf8", DB_USER, DB_PASSWORD);
		 
		// création de la requête sql
		// on teste avant si elle existe ou non (par sécurité)
		$requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
		 
		// on prépare et on exécute la requête
		$pdo->prepare($requete)->execute();

		// connexion à la bdd
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
		
		// on vérifie que la connexion est bonne
		if($connexion){
			// on créer la requête
			$requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`"."Livre"."` (
						`id_livre` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`titre_livre` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
						`genre` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
						`parution` INT NOT NULL,
						`nature` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
						`langue` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
						) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
		 
			// on prépare et on exécute la requête
			$connexion->prepare($requete)->execute();
			$requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`"."Auteur"."` (
						`id_auteur` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`nom_auteur` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
						`prénom_auteur` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
						`naissance` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
						`décès` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-',
						`nationalité` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
						) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
		 
			// on prépare et on exécute la requête
			$connexion->prepare($requete)->execute();
			$requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`"."Editeur"."` (
						`id_editeur` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`nom_éditeur` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
						`site_web` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
						) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
		 
			// on prépare et on exécute la requête
			$connexion->prepare($requete)->execute();
			$requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`"."Ecriture"."` (
						`id_auteur` INT NOT NULL ,
						`id_livre` INT NOT NULL,
						FOREIGN KEY (id_auteur) REFERENCES Auteur(id_auteur),
						FOREIGN KEY (id_livre) REFERENCES Livre(id_livre)
						) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
		 
			// on prépare et on exécute la requête
			$connexion->prepare($requete)->execute();
			$requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`"."Edition"."` (
						`id_editeur` INT NOT NULL ,
						`id_livre` INT NOT NULL,
						FOREIGN KEY (id_editeur) REFERENCES Editeur(id_editeur),
						FOREIGN KEY (id_livre) REFERENCES Livre(id_livre)
						) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
		 
			// on prépare et on exécute la requête
			$connexion->prepare($requete)->execute();
			
		}
	}
	function DropDatabase(){
		$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
		if($connexion){
			$requete = "DROP DATABASE IF EXISTS `".DB_NAME."`";
			$connexion->prepare($requete)->execute(); 
		}
	}
// Insertion du message à l'aide d'une requête préparée

if(isset($_POST['creer'])){
	CreateBase();
}else if(isset($_POST['supprimer'])){
	DropDatabase();
}


// Redirection du visiteur vers la page du minichat
header('Location: index.php');

?>