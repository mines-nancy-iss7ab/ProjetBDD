<?php
define( 'DB_NAME', 'Livres' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
?>

<form method="post">
		<label for="table"> Choisir une table :</label><br/>
		 <select name="questions" action="">
			<option value="question1"> BONJOUROROPFHPRSHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHF </option>
			<option value="livre">livre</option>
			<option value="éditeur">éditeur</option>
			<option value="édité_par">édité par</option>
			<option value="écrit_par">écrit par</option>
		</select> 
		<input type="submit" name="submit" value="Obtenir reponses" />
		</form>
		
		<?php 
		
		if(isset($_POST['submit'])){
			$var = $_POST['questions']
			
			
		
		
		
		}
		
		