<!DOCTYPE html>
<html>
<head>

	<META HTTP-EQUIV="Refresh" CONTENT="30; URL=index.php">
	<link rel="stylesheet" type="text/css" href="minichat.css"> 
	<meta charset="utf-8" />
	<title>MiniChat</title>

</head>
<body>

<h1>MiniChat</h1>

<div class="minichat">

	<div class="haut">

<?php

// Connexion à la base de données
try{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'naya');
}

catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch()){
	echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();

?>

	</div>

	<div class="bas">

	<form action="minichat_post.php" method="post">
		<p>
		<label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo"/>
		<br>
		<label for="message">Message : </label><input type="text" name="message" id="message"/>
		<br>
		<input type="submit" value="Envoyer"/>
		</p>
	</form>

	</div>

</div>

</body>
</html>