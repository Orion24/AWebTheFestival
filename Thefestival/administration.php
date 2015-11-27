<?php
    session_start();
    if(empty($_SESSION['pseudo']))
   {
       session_write_close(); // to be sure
       header('Location: ./login.php');
       exit();
   }
    require_once './functionDb/function_db_select.php';
    require_once './functionDb/function_db_update.php';
    require_once './functionDb/function_db_delete.php';

    $html = "hell0";

    function get_user()
    {
        global $html;
        $html = "<table><tr><th>Nom de l'utilisateur</th><th>Supprimer le compte</th><th>Promouvoir administrateur</th></tr>";
        $array_result = get_user_info();
        foreach ($array_result as $value) {
           $html .= "<tr>";
           $html .= "<td>".$value['pseudo']."</td>";
           $html .= '<td><button class="btn btn-danger" name="SupressionUser" Onclick="window.location.href=\'administration.php?delete='.$value['idUser'].'\'">Supression</button>';
           if($value['isAdmin'] == 0)
           {
             $html .= '<td><button class="btn btn-warning" name="Promouvoir" Onclick="window.location.href=\'administration.php?promote='.$value['idUser'].'\'">Promouvoir</button></td>';
           }
           else {
             $html .= "<td>Déjà administrateur</td>";
           }
           $html .= "<tr>";
        }
        $html .= "</table>";
    }
    function get_artist()
    {
        global $html;
        $html = "<table><tr><th>Nom de l'artiste</th><th>Biographie</th><th>Identifiant de vidéo Youtube</th><th>Supression de l'artiste</th>";
        $array_result = get_array_all_artist();
        foreach ($array_result as $value)
        {
           $html .= "<tr>";
           $html .= "<td>".$value['nameArtist']."<br/><a href=\"./administration.php?m=a&id=".$value['idArtist']."\">Modifier</a></td>";
           $html .= "<td>".$value['bio']."<br/><a href=\"./administration.php?m=b&id=".$value['idArtist']."\">Modifier</a></td>";
           $html .= "<td>".$value['magicCookieYoutube']."<br/><a href=\"./administration.php?m=mgcy&id=".$value['idArtist']."\">Modifier</a></td>";
           $html .= '<td><form method="post"><button class="btn btn-danger" name="SupressionArtist">Supression</button><input type="hidden" name="id" value="'.$value['idArtist'].'"/></from></td>';
           $html .= "</tr>";
        }
        $html .= "</table>";
    }

    function get_comment()
    {
        global $html;
        $array_result = get_array_comment();
        $html = "<table><tr><th>Commentaire</th><th>Auteur</th><th>Valider</th>";
        foreach ($array_result as $value) {
          $user = get_User_by_id($value['idUser']);
          $html .= "<tr><td>".$value['content']."</td>";
          $html .= "<td>".$user['pseudo']."</td>";
          $html .= "<td><a href=\"administration.php?idc=".$value['idComment'].";valid=1\">Oui</a>/<a href=\"administration.php?idc=".$value['idComment']."valid=0\">Non</a></td>";
          $html .= "</tr>";
        }
        $html .= "</table><br/>";
    }


    function modify_artist($mdify, $id)
    {
        global $html;
        $array_result = get_array_artist_id($id);
        $html = '<form method="post">';
        switch ($mdify)
        {
            case 'a':
                $html .= '<label for="'.$mdify.'">Artiste : </label><input type=text placeholder="'.$array_result['nameArtist'].'"class="form-control" name="'.$mdify.'">';
                break;
            case 'b':
                $html .= '<label for="'.$mdify.'">Biographie : </label><br/><textarea name="'.$mdify.'" class="form-control" style="height: 138px; width: 524px;">'.$array_result['bio'].'</textarea><br/>';
                break;
            case 'mgcy':
                $html .= '<label for="'.$mdify.'">Magic Cookie Youtube : </label><input type=text placeholder="'.$array_result['magicCookieYoutube'].'" class="form-control" name="'.$mdify.'" style="width: 130px;">';
                break;
            default :
              header('Location: administration.php');
              exit();
              break;
        }
        $html .= '<input type="hidden" name="id" value="'.$id.'">';
        $html .= '<input type="hidden" name="type" value="'.$mdify.'">';
        $html .= '<button type="submit" class="btn btn-success" name="modifierChamp">Sauvegarder</button>';
        $html .= "</form>";
    }
    if(isset($_REQUEST['v']))
    {
        switch ($_REQUEST['v'])
        {
            case 'a':
                get_artist();
                break;
            case 's':
                get_schedule();
                break;
            case 'u':
                get_user();
                break;
            case 'c':
                get_comment();
            default :
              get_comment();
              break;
        }
    }
    else {
        get_comment();
    }
    if(isset($_REQUEST['m']) && isset($_REQUEST['id']))
    {
       modify_artist($_REQUEST['m'],$_REQUEST['id']);
    }
    if(isset($_REQUEST['modifierChamp']) && isset($_REQUEST['type']))
    {
        modify_artist_db($_REQUEST['type'],$_REQUEST[$_REQUEST['type']],$_REQUEST['id']);
        header('Location: administration.php');
    }
    /*
        On vérifie que le paramètre passé dans l'url est bien un entier car l'identifiant est un entier
     */
    if(isset($_REQUEST['promote']) && is_numeric($_REQUEST['promote']))
    {
        promote_user($_REQUEST['promote']);
    }
    if(isset($_REQUEST['delete']) && is_numeric($_REQUEST['delete']))
    {
       delete_user($_REQUEST['delete']);
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
                    <li class="nav-tabs li"><a href="index.php">Acceuil</a></li>
                </ul>
                <a href="addArtist.php">Ajouter un artiste</a>
            </nav>
        </header>
        <div class="container">
            <div class="jumbotron" style="height : 470px;overflow-y: scroll;">
                <?=$html ?>
            </div>
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav sidebar">
                    <li class="sidebar-brand">
                        <a href="http://127.0.0.1/atelierWebFestival/administration.php?v=a">
                            Administration artistes
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="http://127.0.0.1/atelierWebFestival/administration.php?v=s">
                            Administration horaire
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="http://127.0.0.1/atelierWebFestival/administration.php?v=u">
                            Administration utilisateurs
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="http://127.0.0.1/atelierWebFestival/administration.php?v=c">
                            Administration commentaires
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
