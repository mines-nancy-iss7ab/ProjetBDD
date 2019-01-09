<?php
define( 'DB_NAME', 'Livres' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
?>

<form method="post">
		<label for="table"> Choisir une table :</label><br/>
		 <select name="bonus" action="">
			<option value="1"> 1. Lister tous les genres d'écriture d'Amélie Nothomb  </option>
			<option value="2"> 2. Qui a écrit le plus de nouvelle ?  </option>
			<option value="3"> 3. Lister les livres écrits avant 1968 </option>
			<option value="4"> 4. Quel est la langue la plus utilisée pour écrire ? </option>
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
				$var=$_POST['bonus'];
				switch($var){
					case "1":
					afficherRequete('SELECT DISTINCT genre FROM Livre
					NATURAL JOIN Ecriture
					NATURAL JOIN Auteur
					WHERE nom_auteur ="Nothomb"');
					break;
					
					case "2":
					afficherRequete('SELECT nom_auteur, prénom_auteur, MAX(nb) FROM 
						(SELECT nom_auteur, prénom_auteur, COUNT(*) AS nb FROM Auteur
						NATURAL JOIN Ecriture
						NATURAL JOIN Livre
						WHERE nature = "nouvelle") AS A');
					break;
					
					case "3":
					afficherRequete('SELECT titre_livre FROM Livre
					WHERE parution < 1968');
					break;
					
					case "4":
					afficherRequete('SELECT langue, MAX(nb) FROM 
						(SELECT langue, COUNT(*) AS nb FROM Livre
						GROUP BY langue) AS A');
					break;
				}
			}
			?>