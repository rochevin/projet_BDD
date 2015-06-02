<?php include('connexion.php'); ?>
<?php session_start(); ?>

<?php include('verification.php');?>
<?php 
$req_exam = $bdd->prepare("SELECT `examen`.`examen_id`,`examen`.`examen_nom`,`patient`.`patient_nom`,`patient`.`patient_prenom` FROM `gestion_prescription`.`examen` INNER JOIN `gestion_prescription`.`patient` ON `examen`.`examen_patient_id`=`patient`.`patient_id` WHERE `examen_personnel_id`=1 ORDER BY `examen_date` DESC;");
//On execute
$req_exam->execute(array(
  'utilisateur_id' => $_SESSION['id']
));
$nombre_examen = $req_exam->rowCount();
$resultat_exam = $req_exam->fetchAll();
$req_exam->closeCursor();

//Requete pour ajouter un gène
if (isset($_POST['add_gene'])) {
  $req_gene = $bdd->prepare("INSERT INTO `gestion_prescription`.`gene` (`gene_id`, `gene_nom`, `gene_chromosome`) VALUES (NULL, :nom_gene, :nom_chromosome);");
  //On execute
  $req_gene->execute(array(
    'nom_gene' => htmlspecialchars($_POST['nom_gene']),
    'nom_chromosome' => htmlspecialchars($_POST['list_chromosome'])
  ));
  $req_gene->closeCursor();


}


?>

<?php if ($resultat) { ?>
  <!-- Modal pour affichage pour les administrateurs-->
  <?php if ($_SESSION['rang']==1) { 
     include('administration.php'); 
  }?>
  <!-- Fin Modal pour affichage pour les administrateurs-->
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
                      <li class="list-group-item"><a href="search_exam.php" class="badge"><?php echo $nombre_examen; ?></a>Examens : </li>
                      <li class="list-group-item">Mail : <a class="badge" href="mailto:<?php echo $_SESSION['email']; ?>"><?php echo $_SESSION['email']; ?></a></li>
                    </ul>
                </div>
              </div>
            </div> <!-- cont.row1.col1.row2-->
          </div> <!-- cont.row1.col1-->
          <div class="col-lg-7">
          <div class="well well-lg col-lg-12"><!-- cont.row1.col2-->
            <?php if ($_SESSION['rang']==1) { ?>
              <legend><h3>Panneau d'administration</h3></legend>
              <div class="row">
                <div class="col-lg-3 col-lg-offset-3 text-center">
                  <a class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#add_user"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></br>Utilisateur</a>
                  
                  <a class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#del_patient"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></br>Patient</a>
                </div>
                <div class="col-lg-3 text-center">
                  <a class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#del_user"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></br>Utilisateur</a>
                  <a class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#del_gene"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></br>Gène</a>
                </div>
              </div>
            </div><!-- cont.row1.col2-->
            <?php } ?>
            <div class="well well-lg col-lg-12">
              <legend><h3>Panneau d'utilisateur</h3></legend>
              <div class="row">
                <div class="col-lg-3 col-lg-offset-3 text-center">
                  <a class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#add_gene"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></br>Gène</a>
                  <a class="btn btn-primary btn-lg btn-block" href="panel.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></br>Panel</a>
                </div>
                <div class="col-lg-3 text-center">
                  <a class="btn btn-primary btn-lg btn-block" href="examen.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></br>Examen</a>
                  <a class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#see_exam"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></br>Examen</a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- FIN PREMIERE LIGNE -->
<?php include('footer.php'); ?>


<!-- Modal pour affichage pour tous les utilisateurs-->
<!-- Fenetre qui s'ouvre lorsque l'on clique sur "ajouter un utilisateur" -->
                  <div class="modal fade" id="add_gene" tabindex="-1" role="dialog" aria-labelledby="modal_add_gene" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="modal_add_gene">Créer un gène</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" action="index.php" method="post">
                            <div class="form-group">
                                <label for="nom_gene" class="col-sm-3 control-label">Nom du gène:</label>
                                <div class="col-sm-8 col-sm-offset-1">
                                  <input type="text" class="form-control" id="nom_gene" name="nom_gene">
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="selection_patient">Chromosome :</label>
                              <div class="col-sm-8 col-sm-offset-1">
                                <select class="form-control" id="selection_patient" name="list_chromosome">
                                <option name="1" value="1">Chromosome 1</option>
                                <option name="2" value="2">Chromosome 2</option>
                                <option name="3" value="3">Chromosome 3</option>
                                <option name="4" value="4">Chromosome 4</option>
                                <option name="5" value="5">Chromosome 5</option>
                                <option name="6" value="6">Chromosome 6</option>
                                <option name="7" value="7">Chromosome 7</option>
                                <option name="8" value="8">Chromosome 8</option>
                                <option name="9" value="9">Chromosome 9</option>
                                <option name="10" value="10">Chromosome 10</option>
                                <option name="11" value="11">Chromosome 11</option>
                                <option name="12" value="12">Chromosome 12</option>
                                <option name="13" value="13">Chromosome 13</option>
                                <option name="14" value="14">Chromosome 14</option>
                                <option name="15" value="15">Chromosome 15</option>
                                <option name="16" value="16">Chromosome 16</option>
                                <option name="17" value="17">Chromosome 17</option>
                                <option name="18" value="18">Chromosome 18</option>
                                <option name="19" value="19">Chromosome 19</option>
                                <option name="20" value="20">Chromosome 20</option>
                                <option name="21" value="21">Chromosome 21</option>
                                <option name="22" value="22">Chromosome 22</option>
                                <option name="X" value="23">Chromosome X</option>
                                <option name="Y" value="24">Chromosome Y</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" name="add_gene" value="add_gene" class="btn btn-primary">Créer le gène</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
<!-- Fin Fenetre qui s'ouvre lorsque l'on clique sur "ajouter un utilisateur" -->

  <!-- Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un patient" -->
  <div class="modal fade" id="see_exam" tabindex="-1" role="dialog" aria-labelledby="modal_see_exam" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal_see_exam">Voir tous ses examens</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="page_examen.php" method="get">
            <div class="form-group">
              <label class="col-md-3 control-label" for="selection_patient">Selection :</label>
              <div class="col-md-9">
                <select class="form-control" id="selection_patient" name="id">
                <?php foreach ($resultat_exam as $row) { ?>
                  <option name="<?php echo $row['examen_nom']; ?>" value="<?php echo $row['examen_id']; ?>"><?php echo $row['examen_nom']." (".$row['patient_nom']." ".$row['patient_prenom'].")"; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" name="see_exam" value="see_exam" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Voir l'examen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fin Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un patient" -->

<!-- Fin modal pour tous les utilisateurs -->



<?php } //La fin du if ?>

