

<?php
define( 'DB_NAME', 'Livres' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
if(isset($_POST['ajouterediteur']))
{
	//echo "Vous voulez ajouter un éditeur";
	$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare('INSERT INTO editeur(nom_éditeur,site_web) VALUES(:nom_editeur, :siteweb)');

				$req->execute(array(
					'nom_editeur' => $_POST['nom_editeur'],
					'siteweb' => ($_POST['siteweb']==NULL) ? "-" : $_POST['siteweb']));
}
else if(isset($_POST['ajouterauteur']))
{
	$naiss = new Datetime($_POST['naissance']);
	$mort = new Datetime($_POST['deces']);
	
	//echo "Vous voulez ajouter un auteur";
	$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare('INSERT INTO auteur(nom_auteur, prénom_auteur, naissance, décès, nationalité) VALUES(:nom_auteur, :prenom_auteur, :naissance, :deces, :nationalite)');
				$req->execute(array(
					'nom_auteur' => $_POST['nom_auteur'],
					'prenom_auteur' => $_POST['prénom_auteur'],
					'naissance'=> $naiss->format("d/m/Y"),
					'deces'=> ($_POST['deces']==NULL) ? "-" :$mort->format("d/m/Y"),
					'nationalite'=> $_POST['nationalite']));	
}
else if(isset($_POST['ajouterlivre']))
{
	//echo "Vous voulez ajouter un livre";
	$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare('INSERT INTO livre(titre_livre,genre,parution,nature,langue) VALUES(:titre_livre, :genre,:parution,:nature,:langue)');

				$req->execute(array(
					'titre_livre' => $_POST['titre_livre'],
					'genre' => $_POST['genre'],
					'parution' => $_POST['parution'],
					'nature' => $_POST['nature'],
					'langue' => $_POST['langue']));
}
else if(isset($_POST['ajoutereditepar']))
{
	//echo "Vous voulez ajouter un édité par"; 
	$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare('INSERT INTO edition(id_editeur, id_livre) VALUES(:id_editeur, :id_livre)');

				$req->execute(array(
					'id_editeur' => $_POST['id_editeur'],
					'id_livre' => $_POST['id_livre']));
}
else if(isset($_POST['ajouterecritpar']))
{
	//echo "Vous voulez ajouter Ecrit par";
	$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
				$req = $connexion->prepare('INSERT INTO ecriture(id_auteur, id_livre) VALUES(:id_auteur, :id_livre)');

				$req->execute(array(
					'id_auteur' => $_POST['id_auteur'],
					'id_livre' => $_POST['id_livre']));
}
// Redirection du visiteur vers la page de départ
header('Location: formulaireajout.php');
?>
