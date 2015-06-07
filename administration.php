<?php
//Requête pour récuperer les noms et prénoms des patients
$sql = "SELECT `patient_id`,`patient_nom`,`patient_prenom` FROM `gestion_prescription`.`patient`;";
$reponse = $bdd->query($sql);
$rows_patient = $reponse->fetchAll();
$reponse->closeCursor();
$sql = "SELECT `personnel_id`,`personnel_nom`,`personnel_prenom` FROM `gestion_prescription`.`personnel`;";
$reponse = $bdd->query($sql);
$rows_personnel = $reponse->fetchAll();
$reponse->closeCursor();
$sql = "SELECT `type_personnel_id`,`type_personnel_nom` FROM `gestion_prescription`.`type_personnel`;";
$reponse = $bdd->query($sql);
$rows_type_user = $reponse->fetchAll();
$reponse->closeCursor();
$sql = "SELECT `gene_id`,`gene_nom` FROM `gestion_prescription`.`gene`";
$reponse = $bdd->query($sql);
$rows_gene = $reponse->fetchAll();
$reponse->closeCursor();

//Requete pour suprimmer un utilisateur
if (isset($_POST['del_gene'])) {
  $id_gene = htmlspecialchars($_POST['list_gene']);
  $req_gene = $bdd->prepare("DELETE FROM `gestion_prescription`.`gene` WHERE `gene`.`gene_id` = :id_gene;");
  //On execute
  $req_gene->execute(array(
    'id_gene' => $id_gene
  ));
  $req_gene->closeCursor();


}
?>

  <!-- Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un utilisateur" -->
  <div class="modal fade" id="del_user" tabindex="-1" role="dialog" aria-labelledby="modal_del_user" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal_del_user">Suprimmer un utilisateur</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group">
              <label class="col-md-3 control-label" for="selection_user">Selection :</label>
              <div class="col-md-9">
                <select class="form-control" id="selection_user" name="list_user">
                <?php foreach ($rows_personnel as $row) { ?>
                  <option name="<?php echo $row['personnel_nom']."_".$row['personnel_prenom']; ?>" value="<?php echo $row['personnel_id']; ?>"><?php echo $row['personnel_nom']." ".$row['personnel_prenom']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" name="del_user" value="del_user" class="btn btn-danger">Suprimmer l'utilisateur</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fin Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un utilisateur" -->

  <!-- Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un patient" -->
  <div class="modal fade" id="del_patient" tabindex="-1" role="dialog" aria-labelledby="modal_del_patient" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal_del_patient">Suprimmer un patient</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group">
              <label class="col-md-3 control-label" for="selection_patient">Selection :</label>
              <div class="col-md-9">
                <select class="form-control" id="selection_patient" name="list_user">
                <?php foreach ($rows_patient as $row) { ?>
                  <option name="<?php echo $row['patient_nom']."_".$row['patient_prenom']; ?>" value="<?php echo $row['patient_id']; ?>"><?php echo $row['patient_nom']." ".$row['patient_prenom']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" name="del_patient" value="del_patient" class="btn btn-danger">Suprimmer le patient</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fin Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un patient" -->


  <!-- Fenetre qui s'ouvre lorsque l'on clique sur "ajouter un utilisateur" -->
  <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal_add_user">Ajouter un utilisateur</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group">
                <label for="nom_user" class="col-sm-3 control-label">Nom :</label>
                <div class="col-sm-8 col-sm-offset-1">
                  <input type="text" class="form-control" id="nom_user">
                </div>
            </div>
            <div class="form-group">
                <label for="prenom_user" class="col-sm-3 control-label">Prénom :</label>
                <div class="col-sm-8 col-sm-offset-1">
                  <input type="text" class="form-control" id="prenom_user">
                </div>
            </div>
            <div class="form-group">
                <label for="nom_user" class="col-sm-3 control-label">Email :</label>
                <div class="col-sm-8 col-sm-offset-1">
                  <input type="email" class="form-control" id="mail_user">
                </div>
            </div>
            <div class="form-group">
                <label for="nom_user" class="col-sm-3 control-label">Mot de passe :</label>
                <div class="col-sm-8 col-sm-offset-1">
                  <input type="password" class="form-control" id="nom_user">
                </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="selection_patient">Statut :</label>
              <div class="col-sm-8 col-sm-offset-1">
                <select class="form-control" id="selection_patient" name="list_user">
                <?php foreach ($rows_type_user as $row) { ?>
                  <option name="<?php echo $row['type_personnel_nom']; ?>" value="<?php echo $row['type_personnel_id']; ?>"><?php echo $row['type_personnel_nom']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" name="add_user" value="add_user" class="btn btn-primary">Ajouter un utilisateur</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fin Fenetre qui s'ouvre lorsque l'on clique sur "ajouter un utilisateur" -->

  <!-- Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un gène" -->
  <div class="modal fade" id="del_gene" tabindex="-1" role="dialog" aria-labelledby="modal_del_gene" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal_del_gene">Suprimmer un gène</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group">
              <label class="col-md-3 control-label" for="selection_patient">Selection :</label>
              <div class="col-md-9">
                <select class="form-control" id="selection_patient" name="list_gene">
                <?php foreach ($rows_gene as $row) { ?>
                  <option name="<?php echo $row['gene_nom']; ?>" value="<?php echo $row['gene_id']; ?>"><?php echo $row['gene_nom']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" name="del_gene" value="del_gene" class="btn btn-danger">Suprimmer le gène</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- Fin Fenetre qui s'ouvre lorsque l'on clique sur "suprimmer un patient" -->

