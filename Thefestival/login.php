<?php
  require_once './functionDb/function_db_select.php';
  $nom = "";
  session_start();
  if(isset($_REQUEST['Connexion']))
  {
      $userlogin = login_user($_REQUEST['pseudo'], $_REQUEST['password']);
      $nom = $_REQUEST['pseudo'];
      if ($userlogin != false) {
          $_SESSION['pseudo'] = $userlogin['pseudo'];
          $_SESSION['isAdmin'] = $userlogin['isAdmin'];
          $_SESSION['idUser'] = $userlogin['idUser'];
          header('Location: ./index.php');
          exit();
      }
  }
  if(isset($_REQUEST['deconnect']) && $_REQUEST['deconnect'] == "yes")
  {
      session_destroy();
      session_write_close(); // to be sure
      header('Location: ./index.php');
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
            <div class="jumbotron" style="width : 700px;">
              <form action="login.php" style="margin-left: 240px;margin-top: 70px;" method="post">
                  <div class="form-group">
                      <input type="text" placeholder="Pseudo" class="form-control" value="<?php echo $nom; ?>" name="pseudo">
                  </div>
                  <div class="form-group">
                      <input type="password" placeholder="Password" class="form-control" name="password">
                  </div>
                  <button type="submit" class="btn btn-success" name="Connexion">Connexion</button>
                  <input type="button" onclick="location.href='inscription.php';" name="Connexion" class="btn btn-default" value="inscription"/>
              </form>
            </div>
    </body>
</html>
