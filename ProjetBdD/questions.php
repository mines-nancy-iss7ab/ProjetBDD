<?php
define( 'DB_NAME', 'Livres' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
?>

<form method="post">
		<label for="table"> Choisir une table :</label><br/>
		 <select name="questions" action="">
			<option value="1"> La liste de tous les livres (titre_livre, genre, parution, nature, langue) </option>
			<option value="2"> La liste de tous les auteurs (nom_auteur, prénom_auteur, naissance, décès, nationalité) </option>
			<option value="3"> La liste de tous les éditeurs (nom_editeur, site_web) </option>
			<option value="4"> Le titre et le nom de l’éditeur de tous les livres </option>
			<option value="5"> Le titre, l’auteur et l’éditeur de tous les livres </option>
			<option value="6"> Le titre des livres dont l’auteur est "Isaac Asimov" </option>
			<option value="7"> Le nom des auteurs (sans doublons) publiés par l’éditeur "J’ai Lu" </option>
			<option value="8"> Le nombre de livres écrits par "Amélie Nothomb" </option>
			<option value="9"> Le nombre de livres publiés par Editeur </option>
			<option value="10"> Les Livres de science-ﬁction n’ayant pas été écrit par "Asimov Isaac" </option>
			<option value="11"> Les auteurs publiés par les mêmes éditeurs </option>
			<option value="12"> Les nouvelles de science-ﬁction écrites par "Asimov Isaac" et non éditées par "Gallimard" </option>
			<option value="13"> Les livres écrits par des auteurs décédés </option>
			<option value="14"> Les auteurs ayant écrit des livres de natures diﬀérentes </option>
			<option value="15"> Les auteurs ayant écrit au moins deux livres </option>
		</select> 
		<input type="submit" name="submit" value="Obtenir la réponse" />
		</form>
		
		<?php 
		
		function afficherRequete($requete){
			$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$reponse = $connexion->query($requete);
				
				while ($donnees = $reponse->fetch())
				
				{
					?><tr><?php
					for($i=0; $i<$reponse->columnCount();$i++)
					{
					?><td><?php echo $donnees[$i] ?></td><?php
					echo "&nbsp";
					}
				?></tr><?php
				}
		}
			
			if(isset($_POST['submit'])){
				$var=$_POST['questions'];
				switch($var){
					case "1":
					afficherRequete('SELECT titre_livre, genre, parution, nature, langue FROM Livre');
					break;
					
					case "2":
					afficherRequete('SELECT nom_auteur, prénom_auteur, naissance, décès, nationalité FROM Auteur');
					break;
					
					case "3":
					afficherRequete('SELECT nom_editeur, site_web FROM Editeur');
					break;
					
					case "4":
					afficherRequete('SELECT titre_livre, nom_editeur FROM Edition NATURAL JOIN Livre NATURAL JOIN Editeur');
					break;
					
					case "5":
					afficherRequete('SELECT titre_livre, nom_auteur, nom_editeur FROM Edition 
					NATURAL JOIN Editeur
					NATURAL JOIN Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur');
					break;
					
					case "6":
					afficherRequete('SELECT titre_livre, nom_auteur, nom_editeur FROM Ecriture
					NATURAL JOIN Livre
					NATURAL JOIN Auteur
					WHERE nom_auteur = "Isaac Asimov"');
					break;
					
					case "7":
					afficherRequete('SELECT DISTINCT nom_auteur FROM Edition 
					NATURAL JOIN Editeur
					NATURAL JOIN Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur
					WHERE nom_editeur = "J\'ai Lu"');
					break;
					
					case "8":
					afficherRequete('SELECT COUNT * FROM Livre NATURAL JOIN Ecriture WHERE nom_auteur="Amélie Nothomb"');
					break;
					
					case "9":
					afficherRequete('SELECT COUNT * FROM Edition GROUP BY id_editeur');
					break;
					
					case "10":
					afficherRequete('SELECT titre_livre FROM Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur
					WHERE nature = "science_fiction" AND nom_auteur <> "Asimov Isaac"');
					break;
					
					case "11":
					
					break;
			}
		}
		?>	
