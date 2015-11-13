<?php
    include_once './functionDb/function_db_select.php';
    include_once './functionDb/function_db_insert.php';
    $html = "hell0";
    session_start();
    function add_comment($content, $idArtist)
    {
       insert_comment_artist($_SESSION['idUser'], $idArtist, $content);
       session_write_close();
    }
    function get_comment()
    {
        $tab = get_array_comment_artist($_REQUEST['name']); //TODO : Donner l'id et pas le nom
        $string = "<table><th>Auteur</th><th>Contenu</th><th>Date</th>";
        foreach ($tab as $value) {
          $string .= "<tr><td>".get_User_by_id($value['idUser'])['pseudo']."</td>";
          $string .= "<td>".$value['content']."</td>";
          $string .= "<td>".$value['dateCommentaire']."</td></tr>";
        }
        $string .= "</table>";
        return $string;
    }
    if(isset($_REQUEST['name']))
    {
      global $html;
      $array_result = get_array_artist_name($_REQUEST['name']);
      $html = "<h1>".$array_result['nameArtist']."</h1>";
      $html .= "<p>".$array_result['bio']."</p>";
      $html .= '<p><iframe width="420" height="315" src="https://www.youtube.com/embed/'.$array_result['magicCookieYoutube'].'" frameborder="0" allowfullscreen></iframe></p>';
    }
    else {
      global $html;
      $html = "<table><tr><th>Nom de l'artiste</th><th>Biographie</th>";
      $array_result = get_array_all_artist();
      foreach ($array_result as $value)
      {
         $html .= "<tr>";
         $html .= '<td><a href="artists.php?name='.$value['nameArtist'].'">'.$value['nameArtist'].'</a></td>';
         $html .= "<td>".$value['bio']."</td>";
         $html .= "</tr>";
      }
      $html .= "</table>";
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
                   <?php if(!isset($_SESSION['pseudo'])){ echo '<li class="nav-tabs li"><a href="inscription.php">Inscription</a></li>';}
                    if($isAdmin == 1){echo '<li class="nav-tabs li"><a href="administration.php">Admin</a></li>';}?>
                     <li class="nav-tabs li"><a href="index.php">Acceuil</a></li>
                 </ul>
                 <?php if(isset($_REQUEST['name'])){ echo '<a href="artists.php">Retour à la liste des artistes</a>';}?>
             </nav>
         </header>
         <div class="container">
             <div class="jumbotron" style="height : 370px;overflow-y: scroll; width : 700px;">
                 <?=$html ?>
             </div>
             <?php
                if(isset($_REQUEST['name']))
                {
                  echo '<div class="comment" style="margin-top : 400px;">';
                  echo get_comment();
                  echo '</div>';
                }?>
         </div>
     </body>
 </html>
