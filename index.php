<?php include('connexion.php'); ?>
<?php session_start(); ?>

<?php include('verification.php');?>
<?php 
$req_exam = $bdd->prepare("SELECT COUNT(`examen_id`) AS nombre_exam FROM `gestion_prescription`.`examen` WHERE `examen_personnel_id`=:utilisateur_id;");
//On execute
$req_exam->execute(array(
  'utilisateur_id' => $_SESSION['id']
));
$resultat_exam = $req_exam->fetch();
$req_exam->closeCursor();

?>

<?php if ($resultat) { ?>
<?php include('header.php'); ?>
        <div class="row" id="first_line"> <!-- DEBUT PREMIERE LIGNE cont.row1-->
          <div class="col-lg-3 col-lg-offset-1"> <!-- cont.row1.col1-->
            <div class="row"> <!-- cont.row1.col1.row1-->
              <div class="col-lg-12">
                <ul class="list-group">
                  <li class="list-group-item"><h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Dr. <?php echo $_SESSION['prenom']." ".$_SESSION['nom']; ?></h4></li>
                </ul>
              </div>
            </div> <!-- cont.row1.col1.row1-->
            <div class="row"> <!-- cont.row1.col1.row2-->
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Informations</h3>
                  </div>
                    <ul class="list-group">
                      <li class="list-group-item"><span class="badge"><?php echo $_SESSION['type']; ?></span>Status : </li>
                      <li class="list-group-item"><a href="search_exam.php" class="badge"><?php echo $resultat_exam['nombre_exam']; ?></a>Examens : </li>
                      <li class="list-group-item">Mail : <a class="badge" href="mailto:<?php echo $_SESSION['email']; ?>"><?php echo $_SESSION['email']; ?></a></li>
                    </ul>
                    
                    
                </div>
              </div>
            </div> <!-- cont.row1.col1.row2-->
          </div> <!-- cont.row1.col1-->
          <div class="col-lg-5"><!-- cont.row1.col2-->
            <div class="col-lg-12">
            <?php if ($_SESSION['rang']==1) { ?>
              <div class="row"> <!-- cont.row1.col2.row1-->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Panneau d'administration</h3>
                  </div>
                  <div class="panel-body panel_gestion">
                    <a class="btn btn-danger btn-lg panel_button" href="#"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></br>Prescripteur</a>
                    <a class="btn btn-danger btn-lg panel_button" href="#"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></br>Patient</a>
                    <a class="btn btn-primary btn-lg panel_button" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></br>Prescripteur</a>
                    <a class="btn btn-primary btn-lg panel_button" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></br>Gène</a>
                  </div>
                </div>
              </div> <!-- cont.row1.col2.row1-->
              <?php } ?>
              <div class="row"> <!-- cont.row1.col2.row2-->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Gestion des patients</h3>
                  </div>
                  <div class="panel-body panel_gestion">
                    Panel content
                  </div>
                </div>
              </div> <!-- cont.row1.col2.row2-->
              <div class="row"> <!-- cont.row1.col2.row3-->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                  </div>
                  <div class="panel-body panel_gestion">
                    Panel content
                  </div>
                </div>
              </div> <!-- cont.row1.col2.row3-->
            </div>
          </div><!-- cont.row1.col2-->
        </div> <!-- FIN PREMIERE LIGNE -->
<?php include('footer.php'); ?>
<?php } //La fin du if ?>