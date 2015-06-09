<?php include('connexion.php'); ?>

<?php 
if (isset($_POST['num_secu_patient']) AND isset($_POST['email_patient'])) {
	$req = $bdd->prepare("SELECT `patient_id` FROM `gestion_prescription`.`patient` WHERE `patient_num_secu`=:secu AND `patient_mail`=:email;");
	$num_secu_patient = intval(htmlspecialchars($_POST['num_secu_patient']));
	$email_patient = htmlspecialchars($_POST['email_patient']);
	// Vérification des identifiants
	$req->execute(array(
		'email' => $email_patient,
		'secu' => $num_secu_patient));

	$resultat = $req->fetch();
} else { ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong><span class='glyphicon glyphicon-exclamation-sign'></span></strong> Erreur ! <strong> Veuillez rentrer des informations valides.
	</div>

	<?php include('login.php');
}
?>


<?php if ($resultat) { ?>
	
	

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
					<div class="col-lg-8 col-lg-offset-2">
						<div class="well well-lg">
							<div class="row">
								<div class="col-lg-10 col-lg-offset-1">
									<legend><h1>Rapport d'examen <small>n° 10</small></h1></legend>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-lg-offset-1">
									<div class="row">
										<legend><h4>Information patient </h4></legend>
									</div>
									<div class="row">
										<div clas="col-lg-12">
											<table class="table table-striped">
												<tbody>
													<tr>
														<td><strong>Nom :</strong></td>
														<td><?php echo $row_informations['patient_nom']." ".$row_informations['patient_prenom']; ?></td>
													</tr>
													<tr>
														<td><strong>Numéro de sécu :</strong></td>
														<td><?php echo $row_informations['patient_num_secu']; ?></td>
													</tr>
													<tr>
														<td><strong>Sexe :</strong></td>
														<td><?php echo $row_informations['patient_sexe']; ?></td>
													</tr>
													<tr>
														<td><strong>Date de naissance :</strong></td>
														<td><?php echo $row_informations['patient_date_naissance']; ?></td>
													</tr>
													<tr>
														<td><strong>Email :</strong></td>
														<td><a href="mailto:<?php echo $row_informations['patient_mail']; ?>"><?php echo $row_informations['patient_mail']; ?></a></td>
													</tr>
													<tr>
														<td><strong>Numéro tel :</strong></td>
														<td><?php echo $row_informations['patient_num_tel']; ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-lg-offset-1">
									<div class="row">
										<legend><h4>Information prescripteur </h4></legend>
									</div>
									<div class="row">
										<div clas="col-lg-12">
											<table class="table table-striped">
												<tbody>
													<tr>
														<td><strong>Nom :</strong></td>
														<td><?php echo $row_informations['personnel_nom']; ?></td>
													</tr>
													<tr>
														<td><strong>Prenom :</strong></td>
														<td><?php echo $row_informations['personnel_prenom']; ?></td>
													</tr>
													<tr>
														<td><strong>Mail :</strong></td>
														<td><a href="mailto:<?php echo $row_informations['personnel_mail']; ?>"><?php echo $row_informations['personnel_mail']; ?></a></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8 col-lg-offset-1"> <!-- cont.row1.col1-->
									<div class="row">
										<legend><h4>Fiche de l'examen </h4></legend>
									</div>
									<div class="row">
										<div clas="col-lg-12">
											<table class="table table-striped">
												<tbody>
													<tr>
														<td><strong>Nom :</strong></td>
														<td><?php echo $row_informations['examen_nom']; ?></td>
													</tr>
													<tr>
														<td><strong>Pathologie :</strong></td>
														<td><?php echo $row_informations['examen_pathologie']; ?></td>
													</tr>
													<tr>
														<td><strong>Date :</strong></td>
														<td><?php echo $row_informations['examen_date']; ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div clas="col-lg-12">
											<div >
												<h4>Commentaires :</h4>
												<?php echo $row_informations['examen_commentaires']; ?>
												<legend></legend>
											</div>
										</div>
									</div>
								</div> <!-- cont.row1.col1-->
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
<?php } 
else { ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong><span class='glyphicon glyphicon-exclamation-sign'></span></strong> Erreur ! <strong> Le mail utilisé ou le numéro de sécurité sociale est incorrect.
	</div>
	<?php include('login.php');
}
?>