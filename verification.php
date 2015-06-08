<?php 
if (isset($_SESSION['email']) AND isset($_SESSION['mdp'])) {
	//Préparation de la requête :
	$req = $bdd->prepare("SELECT `personnel`.`personnel_mail`,`personnel`.`personnel_password` FROM `gestion_prescription`.`personnel` WHERE `personnel_mail`=:email AND `personnel_password`=:mdp AND `personnel_actif`=0;");
	$req->execute(array(
		'email' => $_SESSION['email'],
		'mdp' => $_SESSION['mdp']));
	$resultat = $req->fetch();
	if (!$resultat) {
	  include('login.php');
	}
} 
else {
	//Récupération des identifiants de l'utilisateur, connexion à la base, et dans le cas ou celui-ci est enregistré, affichage de l'index
	//Préparation de la requête :
	$req = $bdd->prepare("SELECT `personnel`.`personnel_id`,`personnel`.`personnel_prenom`,`personnel`.`personnel_nom`,`personnel`.`personnel_mail`,`personnel`.`personnel_password`,`type_personnel`.`type_personnel_nom`,`type_personnel`.`type_personnel_rang` FROM `gestion_prescription`.`personnel` INNER JOIN `gestion_prescription`.`type_personnel` ON `personnel`.`personnel_type_personnel_id`=`type_personnel`.`type_personnel_id` WHERE `personnel_mail`=:email AND `personnel_password`=:mdp AND `personnel_actif`=0;");
	// Hachage du mot de passe
	$mdp_utilisateur_hache = sha1($_POST['mdp_utilisateur']);
	$email_utilisateur = htmlspecialchars($_POST['email_utilisateur']);
	// Vérification des identifiants
	$req->execute(array(
		'email' => $email_utilisateur,
		'mdp' => $mdp_utilisateur_hache));

	$resultat = $req->fetch();

	if (!$resultat) {
		include('login.php');
	}
	else { 
		$_SESSION['id'] = $resultat['personnel_id'];
		$_SESSION['email'] = $resultat['personnel_mail'];
		$_SESSION['mdp'] = $resultat['personnel_password'];
		$_SESSION['prenom'] = $resultat['personnel_prenom'];
		$_SESSION['nom'] = $resultat['personnel_nom'];
		$_SESSION['type'] = $resultat['type_personnel_nom'];
		$_SESSION['rang'] = $resultat['type_personnel_rang'];
  }
}
$req->closeCursor();
 ?>