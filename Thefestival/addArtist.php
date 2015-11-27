<?php
  /*
   * Auteur : Bertrand Nicolas
   * Date : 27.11.2011-2015
   * Version : 0.8
   */
  require_once './functionDb/function_db_insert.php';
  if(isset($_REQUEST['Ajout']))
  {
    insert_artist($_REQUEST['nom'], $_REQUEST['bio'], $_REQUEST['mgcy']);
    header('Location: administration.php');
  }
 ?>
<html lang="fr">
    <head>
        <meta charset="utf8" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <header>
            <h1>The Festival</h1>
            <nav>
                <ul class="nav nav-tabs">
                    <li class="nav-tabs li"><a href="index.php">Acceuil</a></li>
                    <li class="nav-tabs li"><a href="administration.php">Admin</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <form id="form" method="post" action="addArtist.php">
                <div class="form-group">
                    <label for="nom">Nom de l'artiste</label> : <input type="text" name="nom" class="form-control" placeholder="nom de l'artiste" style="width : 160px;" maxlength="25" required/><br />
                    <label for="bio">Biographie</label> : <textarea name="bio" class="form-control" style="height: 138px; width: 524px;" required/></textarea><br/>
                    <label for="mgcy">Identifiant vidéo youtube</label> : <input type="text" name="mgcy" class="form-control" placeholder="ex:XEEasR7hVhA" maxlength="12" style="width : 160px;" required/><br/>
                    <button type="submit" class="btn btn-success" name="Ajout">Ajouter</button>
                </div>
            </form>
        </div>
    </body>
</html>
