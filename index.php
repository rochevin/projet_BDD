<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/logo.png">

    <title>Hopital Core Database</title>

    <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap-3.3.4-dist/css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Marvel:400,700' rel='stylesheet' type='text/css'>
  </head>
  <body>
      <div class="container-fluid"> <!-- DEBUT CONTAINER cont-->
        <div class="row"> <!-- DEBUT NAVBAR cont.navbar-->
          <?php include('navbar.php'); ?>
        </div> <!-- FIN NAVBAR -->
        <div class="row" id="first_line"> <!-- DEBUT PREMIERE LIGNE cont.row1-->
          <div class="col-lg-3 col-lg-offset-1"> <!-- cont.row1.col1-->
            <div class="row"> <!-- cont.row1.col1.row1-->
              <div class="col-lg-12">
                <ul class="list-group">
                  <li class="list-group-item"><h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Dr. George Michael</h4></li>
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
                      <li class="list-group-item"><span class="badge">Administrateur</span>Status : </li>
                      <li class="list-group-item"><a href="#" class="badge">23</a>Patients : </li>
                      <li class="list-group-item">Mail : <a class="badge" href="mailto:george.michael@coucou.fr">george.michael@coucou.fr</a></li>
                    </ul>
                    
                    
                </div>
              </div>
            </div> <!-- cont.row1.col1.row2-->
          </div> <!-- cont.row1.col1-->
          <div class="col-lg-5"><!-- cont.row1.col2-->
            <div class="col-lg-12">
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
        <div class="row"> <!-- DEBUT FOOTER -->
          <?php include('footer.php'); ?>
        </div> <!-- FIN FOOTER -->
      </div> <!-- FIN CONTAINER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="bootstrap-3.3.4-dist/js/jquery-1.11.3.js"></script>
    <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
</html>