<?php
  /*
   * Auteur : Bertrand Nicolas
   * Date : 27.11.2011-2015
   * Version : 0.8
   */
    require_once './functionDb/function_db_insert.php';
    function testArg($tab) //Check if there are empty cells
    {
        foreach($tab as $value)
        {
            if(!isset($value) || empty($value))
            {
                return false;
            }
        }
        return true;
    }

    if(isset($_REQUEST['Inscription']) && testArg([$_REQUEST['pseudo'], $_REQUEST['pass']]))
    {
        insertUser( $_REQUEST['pseudo'], $_REQUEST['pass']);
        header('Location: index.php');
        exit();
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
                </ul>
            </nav>
        </header>
        <div class="container">
            <form id="form" method="post" action="inscription.php">
                <div class="form-group">
                    <label for="pseudo">Votre pseudo</label> : <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo" required/><br />
                    <label for="pass">Votre mot de passe :</label><input type="password" name="pass" class="form-control" id="pass" placeholder="Mot de passe" required/><br />
                    <button type="submit" class="btn btn-success" name="Inscription">Inscription</button>
                </div>
            </form>
        </div>
    </body>
</html>
