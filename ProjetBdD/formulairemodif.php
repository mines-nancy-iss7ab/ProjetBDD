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
			<option value="editeur">éditeur</option>
			<option value="ecriture">édité par</option>
			<option value="edition">écrit par</option>
		</select> 
		<input type="submit" name="submit" value="choisir" />
		</form>
		<table>
		<?php 
			if(isset($_POST['submit'])){
				$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$reponse = $connexion->query('SELECT * FROM '.$_POST['table']);
				
				while ($donnees = $reponse->fetch())
				
				{
					?><tr><?php
					for($i=0; $i<$reponse->columnCount();$i++)
					{
					?><td><?php echo $donnees[$i]?></td><?php
					}
				?><td><form method="post" action="traitementmodifier.php"><input type="submit" name="submit" value="modifier" />
		</form></td>
		<td><form method="post" action="traitementmodifier.php"><input type="submit" name="submit" value="supprimer" />
		</form></td></tr><?php
				}
			}
		?>
		</table>
	</body>
</html>