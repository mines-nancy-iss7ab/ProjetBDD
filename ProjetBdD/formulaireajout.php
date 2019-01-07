
<!DOCTYPE html>
<html>
			
	
	<body>
		
		<form method="post">
		<label for="table"> Choisir une table :</label><br/>
		 <select name="table" action="">
			<option value="auteur">auteur</option>
			<option value="livre">livre</option>
			<option value="éditeur">éditeur</option>
			<option value="édité_par">édité par</option>
			<option value="écrit_par">écrit par</option>
		</select> 
		<input type="submit" name="submit" value="ajouter" />
		</form>
		<?php 
			if(isset($_POST['submit'])){
				$var=$_POST['table'];
				switch($var){
					case "éditeur":
					?>
				
					<form method="post" action="traitementajout.php">
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
					<form method="post" action="traitementajout.php">
					<label id="Nom_auteur"> Nom auteur:</label><br/>
					<input type="text" name="nom_auteur"><br/>

					<label id="Prénom">Prénom : </label><br/>
					<input type="text" name="prénom_auteur"><br/>
					
					<label id="Naissance">Naissance : </label><br/>
					<input type="number" name="naissance"><br/>
					<label id="Décès">Décès : </label><br/>
					<input type="number" name="deces"><br/>
					<label id="Nationalité">Nationalité : </label><br/>
					<input type="text" name="nationalite"><br/>
					<input type="submit" name="ajouterauteur" value="Ajouteur valeur"/>
					</form>
					<?php
						break;
					case "livre":
					?>
					<form method="post" action="traitementajout.php">
					<label id="titre_livre"> Titre :</label><br/>
					<input type="text" name="titre_livre"><br/>

					<label id="genre">Genre : </label><br/>
					<select name="genre" action="">
						<option value="fantastique">fantastique</option>
						<option value="sentimental">sentimental</option>
						<option value="amour">amour</option>
						<option value="comédie">comédie</option>
						<option value="essai">essai</option>
						<option value="histoire">histoire</option>
						<option value="science">science</option>
						<option value="philosophie">philosophie</option>
						<option value="poésie">édité par</option>
						<option value="religion">religion</option>
						<option value="science_fiction">science-fiction</option>
						<option value="suspens">suspens</option>
						<option value="policier">policier</option>
						<option value="technique">technique</option>
						<option value="roman">roman</option>
						<option value="théatre">théatre</option>
						<option value="humour">humour</option>
					</select><br/>
					<label id="Parution">Parution : </label><br/>
					<input type="number" name="parution"><br/>
					<label id="Nature">Nature : </label><br/>
					<select name="nature" action="">
						<option value="BD">BD</option>
						<option value="roman">roman</option>
						<option value="nouvelle">nouvelle</option>
						<option value="cours">cours</option>
						<option value="manuel">manuel</option>
						<option value="theatre">théâtre</option>
					</select><br/>
					<label id="langue"> Langue :</label><br/>
					<input type="text" name="langue"><br/>
					<input type="submit" name="ajouterlivre" value="Ajouteur valeur"/>
					</form>
					<?php
						break;
					case "édité_par": 
					?>
					<form method="post" action="traitementajout.php">
					<label id="id_editeur"> id éditeur:</label><br/>
					<input type="number" name="id_editeur"><br/>
					<label id="id_livre"> id livre:</label><br/>
					<input type="number" name="id_livre"><br/>
					<input type="submit" name="ajoutereditepar" value="Ajouteur valeur"/>
					</form>
					<?php
						break;
					case "écrit_par": 
					?>
					<form method="post" action="traitementajout.php">
					<label id="id_auteur"> id auteur:</label><br/>
					<input type="number" name="id_auteur"><br/>
					<label id="id_livre"> id livre:</label><br/>
					<input type="number" name="id_livre"><br/>
					<input type="submit" name="ajouterecritpar" value="Ajouteur valeur"/>
					</form>
					<?php
				}
			}
			
		/*	if(isset($_POST['ajouterediteur'])){
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