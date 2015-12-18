<?php
    /*
    * Auteur : Bertrand Nicolas
    * Date : 27.11.2015
    * Version : 0.8
     */
    require_once './functionDb/function_db_select.php';
    include_once './addComment.php';
    session_start();
    $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false; //condition ternaire : Si la variable existe on lui met sa valeur et elle existe pas on lui met false

    function get_upcoming_event()
    {
      /*
       * Auteur  : Marin Verstraete
       * Modifier par : Bertrand Nicolas
       * Classe  : I.IN-P4B
       * Date    : 11.12.2015
       * Version : 1.0
       */

      include(__DIR__ . '/google-api-php-client-master/src/Google/autoload.php');

      // Le nom de l'application, ne pose pas de problème s'il est faux
      define('APP_NAME', 'the-festival');

      // La clé serveur de l'application, doit être générée dans
      // Google Developers Console > Gestionnaire d'API > Identifiants puis
      // 'Ajouter des identifiants' -> Clé API -> Clé Serveur
      define('DEV_KEY', 'AIzaSyCKFPxJx50GXgjaX2aBlLgHLob1GblDOUk');

      // L'identifiant du calendrier dont on veux récupérer les évenements
      // http://wpdocs.philderksen.com/google-calendar-events/getting-started/find-calendar-id/
      define('CAL_ID', '2uhkj6pjjarjqff9vhsbrjnobs@group.calendar.google.com');

      $client = new Google_Client();
      $client->setApplicationName(APP_NAME);
      $client->setDeveloperKey(DEV_KEY);

      $service = new Google_Service_Calendar($client);

      $params = array(
        // Le nombre max d'évenements (s'il n'est pas présent, tout les évenements sont retournés)
        'maxResults' => 20,

        // L'ordre des évenements
        'orderBy' => 'startTime',

        // Ce paramètre permet d'obtenir les evenement depuis aujourd'hui (et pas ceux d'avant)
        // date('c') formatte la date actuelle conformément à la RFC 2822
        'timeMin' => date('c'),

        'singleEvents' => TRUE,
      );

      // Récupération des évenements
      $events = $service->events->listEvents(CAL_ID, $params);

      if(count($events->getItems()) == 0) {
        // Pas d'évenements dans le calendrier
        return 'No upcoming events found.';
      }
      else {

        $html = "";
        foreach($events->getItems() as $event) {
          // La date de l'évenement
          $start = $event->start->dateTime;

          if(empty($start)) {
            $start = $event->start->date;
          }

          // Je formatte la date pour que ce soit lisible
          $date = date('d/m à G:i', strtotime($start));

          $artist = $event->getSummary(); //On récupère le nom de l'artiste qui est le nom de l'événement
          $eventCalendar = '<a href="artists.php?name='.$artist.'">'.$artist.'</a>';
          $eventCalendar .= " le ".$date;
			    $html .= "<li>".$eventCalendar."</li>";
        }
        return $html;
      }
    }

    if(isset($_REQUEST['AjoutCommentaire']))
    {
      add_comment($_REQUEST['contenu'], $_SESSION['idUser'], $_REQUEST['id'], 's');
    }

    $artists = "";
    $array_artist = get_name_artist(5); //On récupère les 5 premier noms
    foreach ($array_artist as $value) //Pour chaque artiste
    {
      $name = $value['nameArtist'];
      $artists .= '<li><a href="artists.php?name='.$name.'" style="text-decoration:underline";>'.$name.'</a></li>';
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
                    <li class="nav-tabs li"><a href="artists.php">Artiste</a></li>
                    <?php if(!isset($_SESSION['pseudo'])){ echo '<li class="nav-tabs li"><a href="inscription.php">Inscription</a></li>';}
                     if($isAdmin == 1){echo '<li class="nav-tabs li"><a href="administration.php">Admin</a></li>';}?>
                </ul>
                <?php if(!isset($_SESSION['pseudo'])){ //Si l'utilisateur est  pas connecté
                    echo '<form class="navbar-form navbar-left" action="login.php" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="Pseudo" class="form-control" name="pseudo">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-success" name="Connexion">Connexion</button>
                    <input type="button" onclick="location.href=\'inscription.php\';" value="Inscription" class="btn btn-default"/>
                </form>
                ';}
                else {
                  echo '<a href="login.php?deconnect=yes">Deconnexion</a>';
                }?>
            </nav>
        </header>
        <div class="container">
            <div class="jumbotron">
                    <iframe src="https://calendar.google.com/calendar/embed?src=2uhkj6pjjarjqff9vhsbrjnobs%40group.calendar.google.com&ctz=Europe/Zurich" style="border: 0" width="500" height="300" frameborder="0" scrolling="no"></iframe>
            </div>
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav sidebar">
                    <li class="sidebar-brand">
                        <a href="artists.php">
                            Artistes
                        </a>
                    </li>
                    <?=$artists ?>
                </ul>
                <ul class="sidebar-nav sidebar">
                    <li>Evenement à venir<li>
                    <?php echo get_upcoming_event(); ?>
                </ul>
            </div>
            <div class="comment">
              <?php
                  if(!empty($_SESSION['idUser']))//Si un utilisateur est connecté il peut commenter
                  { echo '
                  <form id="form" method="post" action="index.php" style="height : 180px;">
                      <div class="form-group" style="margin-left : 10px;">
                          <label for="contenu">Votre commentaire</label> : <textarea type="text" name="contenu" class="form-control" style="height: 108px; width: 524px;" maxlength="200" required/></textarea>
                          <input type="hidden" name="type" value="s">
                          <input type="hidden" name="id" value="0">
                          <input type="hidden" name="idUser" value="'.$_SESSION['idUser'].'">
                          <button type="submit" class="btn btn-success" name="AjoutCommentaire">Ajouter</button>
                      </div>
                  </form>
                  ';}
                  else {
                    echo '<h2>Vous devez être connecté pour commenter</h2>';
                  }?>
            </div>
        </div>
    </body>
</html>
