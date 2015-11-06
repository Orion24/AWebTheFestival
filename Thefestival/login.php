<?php
  require_once './functionDb/function_db_select.php';
  $nom = "";
  if(isset($_REQUEST['Connexion']))
  {
      $userlogin = login_user($_REQUEST['pseudo'], $_REQUEST['password']);
      $nom = $_REQUEST['pseudo'];
      if ($userlogin != false) {
          session_start();
          $_SESSION['pseudo'] = $userlogin['pseudo'];
          $_SESSION['isAdmin'] = $userlogin['isAdmin'];
          header('Location: ./index.php');
          exit();
      }
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
            </nav>
        </header>
        <div class="container">
            <div class="jumbotron" style="width : 700px;">
              <form action="login.php" style="margin-left: 240px;margin-top: 70px;" method="post">
                  <div class="form-group">
                      <input type="text" placeholder="Pseudo" class="form-control" value="<?php= $nom ?>" name="pseudo">
                  </div>
                  <div class="form-group">
                      <input type="password" placeholder="Password" class="form-control" name="password">
                  </div>
                  <button type="submit" class="btn btn-success" name="Connexion">Connexion</button>
                  <input type="button" onclick="location.href='inscription.php';" name="Connexion" class="btn btn-default" />
              </form>
            </div>
    </body>
</html>
