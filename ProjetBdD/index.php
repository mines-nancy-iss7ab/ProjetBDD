<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Projet BDD</title>
	</head>
	
	<body>
		<header>
		Projet Bases  de données.
		</header>
		<form action="creerbase.php" method="post">
		<input type="submit" value="Créer base" name="creer"/><br/>
		<input type="submit" value="Supprimer base" name="supprimer"/>
		</form>
		
		<form action="remplirtables.php" method="post">
		<input type="submit" value="Remplir tables" name="remplir"/>
		</form>
		<form action="formulaireajout.php" method="post">
		<input type="submit" value="Ajouter ligne" name="ajouter"/>
		</form>
		<form action="formulairemodif.php" method="post">
		<input type="submit" value="Modifier table" name="modifier"/>
		</form>
		<form action="questions.php" method="post">
		<input type="submit" value="Réponses aux questions" name="questions"/>
		</form>
		
	</body>
</html>
