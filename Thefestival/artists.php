<?php
    /*
    * Auteur : Bertrand Nicolas
    * Date : 27.11.2015
    * Version : 0.8
     */
    include_once './functionDb/function_db_select.php';
    include_once './functionDb/function_db_insert.php';
    $html = "hell0";
    $commentaire = "";
    session_start();
    $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false; //condition ternaire : Si la variable existe on lui met sa valeur et elle existe pas on lui met false

    function add_comment($content, $idArtist)
    {
       insert_comment_artist($_SESSION['idUser'], $idArtist, $content);
    }
    function get_comment()
    {
        $idArtist = get_idArtist_by_name($_REQUEST['name']);
        $tab = get_array_comment_artist($idArtist['idArtist']);

        if(count($tab) > 0)
        {
          $string = "<table><th>Auteur</th><th>Contenu</th><th>Date</th>";
          foreach ($tab as $value) {
            $string .= "<tr><td>".get_User_by_id($value['idUser'])['pseudo']."</td>";
            $string .= "<td>".$value['content']."</td>";
            $date = $value['dateCommentaire'];
            $date_format = date("d-m-Y", strtotime($date)); //Conversion de année-mois-jour en jour-mois-année (en chiffre)
            $string .= "<td>".$date_format."</td></tr>";
          }
          $string .= "</table>";
          return $string;
        }
        else {
          return "<h1>Pas de commentaire pour le moment</h1>";
        }
    }
    if(isset($_REQUEST['name'])) //Si on a donné un nom en paramètre (affichage des données de l'artiste)
    {
      global $html;
      $array_result = get_array_artist_name($_REQUEST['name']);
      if($array_result != false) //Si on a trouver un artiste sous ce nom
      {
        $html = "<h1>".$array_result['nameArtist']."</h1>";
        $html .= "<p>".$array_result['bio']."</p>";
        $html .= '<p><iframe width="420" height="315" src="https://www.youtube.com/embed/'.$array_result['magicCookieYoutube'].'" frameborder="0" allowfullscreen></iframe></p>';
          if(!empty($_SESSION['idUser']))
          {
          $commentaire = '<form id="form" method="post" style="height : 180px;" action="artists.php">
                              <div class="form-group">
                                  <label for="contenu">Votre Commentaire</label><br /><textarea name="contenu" class="form-control" style="height: 138px; width: 250px;" required/></textarea><br/>
                                  <input type="hidden" name="type" value="a">
                                  <input type="hidden" name="id" value="'.get_idArtist_by_name($_REQUEST['name'])['idArtist'].'">
                                  <input type="hidden" name="idUser" value="'.$_SESSION['idUser'].'">
                                  <button type="submit" class="btn btn-success" name="AjoutCommentaire">Ajouter</button>
                              </div>
                          </form>';
          }
          else {
            $commentaire = "<h2>Pour commenter veuillez vous connecter</h2>";
          }
      }
      else {
        $html = "<h1>Pas d'artiste sous ce nom là.</h1>";
      }
    }
    else {
      global $html;
      $html = "<table><tr><th>Nom de l'artiste</th><th>Biographie</th>";
      $array_result = get_array_all_artist();
      foreach ($array_result as $value) //Pour chaque artistes dans le tableau
      {
         $html .= "<tr>";
         $html .= '<td><a href="artists.php?name='.$value['nameArtist'].'">'.$value['nameArtist'].'</a></td>';
         $html .= "<td>".$value['bio']."</td>";
         $html .= "</tr>";
      }
      $html .= "</table>";
    }
    if(isset($_REQUEST['AjoutCommentaire'])) //Si on a envoyé le formulaire pour les commentaires
    {
      add_comment($_REQUEST['contenu'], $_REQUEST['id'], $_REQUEST['idUser'], 'a');
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
                   <?php if(!isset($_SESSION['pseudo'])){ echo '<li class="nav-tabs li"><a href="inscription.php">Inscription</a></li>';} //Si nous sommes déjà connecter pas besoins de le refaire
                    if($isAdmin == 1){echo '<li class="nav-tabs li"><a href="administration.php">Admin</a></li>';} //Si on est administrateur on nous donne l'accès à la page?>
                     <li class="nav-tabs li"><a href="index.php">Acceuil</a></li>
                 </ul>
                 <?php
                 if(isset($_REQUEST['name']))//Si on est sur un page d'artiste spécifique on peut retourner à la page principale
                 {
                   echo '<a href="artists.php">Retour à la liste des artistes</a>';
                 }
                 else {
                   echo '<h2> Liste des artistes </h2>';
                 }
                 ?>
             </nav>
         </header>
         <div class="container">
             <div class="jumbotron" style="height : 440px;overflow-y: scroll; width : 700px;">
                 <?=$html ?>
             </div>
             <?php
                if(isset($_REQUEST['name']))
                {
                  echo '<div class="comment" style="margin-top : 450px; overflow-y : scroll;">';
                  echo get_comment();
                  echo $commentaire;
                  echo '</div>';
                }?>
         </div>
     </body>
 </html>
