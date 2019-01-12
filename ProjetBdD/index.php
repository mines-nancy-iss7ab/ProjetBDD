<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Projet BDD</title>
	</head>
	
	<body>
		<header>
		Projet Bases  de données. N. Miguens et E. Rigaud
		</header>
		
		<h1> Page d'accueil </h1>
		 <div class="container">
		<form action="creerbase.php" method="post">
		<input type="submit" value="Créer base" name="creer"/><br/>
		<input type="submit" value="Supprimer base" name="supprimer"/>
		</form>

		<form action="remplirtables.php" method="post">
		<input type="submit" value="Remplir tables" name="remplir_tables"/>
		</form>
		<br/>
		<form action="formulaireajout.php" method="post">
		<input type="submit" value="Ajouter ligne" name="ajouter"/>
		</form>
		<form action="formulairemodif.php" method="post">
		<input type="submit" value="Modifier table" name="modifier"/>
		</form>
		<br/>
		<form action="questions.php" method="post">
		<input type="submit" value="Réponses aux questions" name="questions"/>
		</form>
		<form action="bonus.php" method="post">
		<input type="submit" value="Réponses aux 4 questions bonus" name="bonus"/>
		</form>
		</div>
	</body>
	
</html>
