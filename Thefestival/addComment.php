<?php
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
            <form id="form" method="post" action="addComment.php">
                <div class="form-group">
                    <label for="nom">Nom de l'artiste</label> : <input type="text" name="nom" class="form-control" placeholder="nom de l'artiste" style="width : 160px;" maxlength="25" required/><br />
                    <button type="submit" class="btn btn-success" name="Ajout">Ajouter</button>
                </div>
            </form>
        </div>
    </body>
</html>
