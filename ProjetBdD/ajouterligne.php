
<!DOCTYPE html>
<?php 
	define( 'DB_NAME', 'Livres' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
?>
	
<html>
			
	
	<body>
		
		<form method="post">
		<label for="table"> Choisir une table :</label><br/>
		 <select name="table" action="">
			<option value="auteur">auteur</option>
			<option value="livre">livre</option>
			<option value="éditeur">éditeur</option>
		</select> 
		<input type="submit" name="submit" /><br/>
		<?php 
			if(isset($_POST['table'])){
				$var=$_POST['table'];
				switch($var){
					case "éditeur":
					?>
				
					
					<label id="Nom_editeur"> Nom éditeur:</label><br/>
					<input type="text" name="nom_editeur"><br/>

					<label id="siteweb">Site web : </label><br/>
					<input type="text" name="siteweb"><br/>
					<input type="submit" name="ajouterediteur" value="Ajouteur valeur"/>
					</form>
					<?php
						break;
					case "auteur":
					?>
					<label id="Nom_auteur"> Nom auteur:</label><br/>
					<input type="text" name="nom_auteur"><br/>

					<label id="Prénom">Prénom : </label><br/>
					<input type="text" name="prénom"><br/>
					
					<label id="Naissance">Naissance : </label><br/>
					<input type="number" name="naissance"><br/>
					<label id="Décès">Décès : </label><br/>
					<input type="number" name="décès"><br/>
					<label id="Nationalité">Nationalité : </label><br/>
					<input type="text" name="nationalité"><br/>
					<input type="submit" name="ajouterauteur" value="Ajouteur valeur"/>
					</form>
					<?php
						break;
				}
			}
			
			if(isset($_POST['ajouterediteur'])){
				$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare('INSERT INTO editeur(nom_éditeur,site_web) VALUES(:nom_editeur, :siteweb)');

				$req->execute(array(
					'nom_editeur' => $_POST['nom_editeur'],
					'siteweb' => $_POST['siteweb']));
			}else if(isset($_POST['ajouterauteur'])){
				$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare("INSERT INTO auteur(nom_auteur,prénom_auteur,naissance,décès,nationalité) VALUES(".$_POST['nom_auteur'].", ".$_POST['prénom'].", ".$_POST['naissance'].", ".$_POST['décès'].", ".$_POST['nationalité'].")");
				$req->execute();
				echo "done"; 
			}
			/*	$req->execute(array(
					'nom_auteur' => $_POST['nom_auteur'],
					'prénom_auteur' => $_POST['prénom'],
					'naissance'=> $_POST['naissance'],
					'décès'=> $_POST['décès'],
					'nationalité'=> $_POST['nationalité']));
				}*/
			
			?>
			
	</body>
</html>