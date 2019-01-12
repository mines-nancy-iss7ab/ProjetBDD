<!DOCTYPE html>
<?php
define( 'DB_NAME', 'Livres' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
?>

<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css" />
		
	</head>
	
	<body>
		
		<a href="index.php" >Accueil</a><br/>
		<h1> Modification ou Suppression de ligne </h1>
		<?php
		if(isset($_POST['table'])){
		$table = $_POST['table'];}
?>
		<p> Choisissez une table, et une ligne à modifier ou supprimer. Modifiez les champs et cliquez sur "Modifier", ou simplement cliquez sur "Supprimer". Si les champs rentrés ne sont pas corrects
        (en particulier lors de la modificication des tables Edite_par et Ecrit_Par, aucun chagement de sera effectuer. Ainsi, il faut s'assurer que les valeurs rentrées sont valides.	</p>
		
		<form method="post">
		<label for="table"> Choisir une table :</label><br/>
		 <select name="table" id="selection" action=""  required>
			<option disabled="disabled" selected="selected">Select an option.</option>
		
	<option value="auteur"<?php if (isset($table) && $table=="auteur") echo "selected";?>>auteur</option>
    <option value="livre" <?php if (isset($table) && $table=="livre") echo "selected";?>>livre</option>
    <option value="editeur" <?php if (isset($table) && $table=="editeur") echo "selected";?>>éditeur</option>

    <option value="ecriture" <?php if (isset($table) && $table=="ecriture") echo "selected";?>>écrit par</option>
    <option value="edition" <?php if (isset($table) && $table=="edition") echo "selected";?>>édité par</option>
		</select> 
		<input type="submit" name="choisirmodif" value="choisir" />
		
		<br/>
		<?php 
			if(isset($_POST['choisirmodif'])){
				$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$reponse = $connexion->query('SELECT * FROM '.$_POST['table']);
				for($i=0; $i<$reponse->columnCount();$i++)
					{
					
					
					
					?>Champ <?php echo $i?> :<input type="text" id="<?php echo $i?>" name="<?php echo $i?>"><input type="text" name="invisible<?php echo $i?>"  id="invisible<?php echo $i?>" class="invisible"><?php }
			
		}?>
		
		<input type="submit" formaction="traitementmodifier.php" name="modifier" value="modifier" />
		<input type="submit" name="supprimer" formaction="traitementmodifier.php" value="supprimer" />
		</form>
		<br/><br/>
		<table id="table">
		<?php 
			if(isset($_POST['choisirmodif'])){
				$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$reponse = $connexion->query('SELECT * FROM '.$_POST['table']);
				$row=0; 
				while ($donnees = $reponse->fetch())
				
				{
					?><tr><?php
					for($i=0; $i<$reponse->columnCount();$i++)
					{
					?><td><?php echo $donnees[$i]?></td><?php
					}
					
				?><td><button onclick = Myfunction(<?php echo $row ?>) >Modifier/Supprimer</button>
				<script>
					function Myfunction(row)
					{
                    	 var table = document.getElementById('table');
						 for(var i=0; i<table.rows[row].cells.length; i++){
                         document.getElementById(i.toString()).value = table.rows[row].cells[i].innerHTML ;
						 document.getElementById("invisible".concat(i.toString())).value = table.rows[row].cells[i].innerHTML;
						 }
                    }
				</script>
		</td>
		</tr><?php
					$row=$row+1; 
				}
			}
		?>
		</table>
		     
	</body>
</html>