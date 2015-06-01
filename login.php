<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Hopital Core Database</title>

		<link href="source/css/bootstrap.min.css" rel="stylesheet">
		<link href="source/css/style.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Marvel:400,700' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="container-fluid"> <!-- DEBUT CONTAINER cont-->
		<div class="row" id="first_line"> <!-- DEBUT PREMIERE LIGNE cont.row1-->
		<div class="col-lg-4 col-lg-offset-4">
			<div class="row">
				<div class="well well-lg">
					<legend><h2 class="text-center">Hopital Core Database</h2></legend>
					<form method="post" action="index.php">
						<div class="form-group">
							<label for="mail">Adresse Email</label>
							<input name="email_utilisateur" type="email" class="form-control" id="mail" placeholder="Entrez votre adresse email">
						</div>
						<div class="form-group">
							<label for="mdp">Mot de passe</label>
							<input name="mdp_utilisateur" type="password" class="form-control" id="mdp" placeholder="Entrez votre mot de passe">
						</div>
						<legend></legend>
						<button type="submit" class="btn btn-primary btn-lg btn-block">Connexion</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="well well-lg">
					<legend><h2 class="text-center">Vous êtes un patient ?</h2></legend>
					<button type="button" class="btn btn-danger btn-lg btn-block">Résultats d'examen</button>
				</div>
			</div>
		</div>
		</div> <!-- FIN PREMIERE LIGNE -->
		</div> <!-- FIN CONTAINER -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<script src="source/js/jquery.js"></script>
		<script src="source/js/bootstrap.min.js"></script>
	</body>
</html>