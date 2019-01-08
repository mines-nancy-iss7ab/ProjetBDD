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
					 echo "<td>".$donnees[$i]."</td>" ;
					echo "&nbsp";
					}
					echo "<br>";
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
					afficherRequete('SELECT DISTINCT nom_auteur, nom_editeur FROM Edition 
					NATURAL JOIN Editeur
					NATURAL JOIN Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur AS A
					INNER JOIN (SELECT * FROM Edition 
						NATURAL JOIN Editeur
						NATURAL JOIN Livre
						NATURAL JOIN Ecriture
						NATURAL JOIN Auteur) AS B 
					ON A.id_editeur = B.id_editeur
					WHERE A.nom_auteur <> B.nom_auteur
					ORDER BY nom_editeur');
					break;
					
					case "12":
					afficherRequete('SELECT titre_livre FROM Edition 
					NATURAL JOIN Editeur
					NATURAL JOIN Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur 
					WHERE genre ="science_ﬁction" AND nom_auteur="Asimov Isaac" 
					AND nom_editeur = "Gallimard" AND nature = "nouvelles"');
					break;
					
					case "13":
					afficherRequete('SELECT titre_livre FROM Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur
					WHERE Décès = "-"');
					break;
					
					case "14":
					afficherRequete('SELECT DISTINCT nom_auteur FROM Livre AS A 
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur
					INNER JOIN (SELECT * FROM Livre 
						NATURAL JOIN Ecriture
						NATURAL JOIN Auteur)
					AS B ON A.nom_auteur = B.nom_auteur
					WHERE A.nature <> B.nature');
					break;
					
					case "15":
					afficherRequete('SELECT nom_auteur FROM (SELECT nom_auteur, COUNT (*) AS nombre_livre
						FROM Auteur
						NATURAL JOIN Ecriture
						NATURAL JOIN Livre
						GROUP BY nom_auteur);
					WHERE nombre_livre > 1');
					break;
			}
		}
		?>	
