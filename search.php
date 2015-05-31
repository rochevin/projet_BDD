<?php include('connexion.php'); ?>

<?php 
//Requête pour récuperer les noms et prénoms des patients
$sql = "SELECT `patient_id`,`patient_nom`,`patient_prenom` FROM `gestion_prescription`.`patient`;";
$reponse = $bdd->query($sql);
$rows_patient = $reponse->fetchAll();
$reponse->closeCursor();
?>


<?php include('header.php'); ?>
		<div class="row" id="first_line"> <!-- DEBUT PREMIERE LIGNE cont.row1-->
			<div class="col-lg-8 col-lg-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Examens</h3>
					</div>
					
				</div>
			</div>
 		</div> <!-- FIN PREMIERE LIGNE -->
<?php include('footer.php'); ?>