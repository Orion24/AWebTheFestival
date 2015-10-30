<?php
    require_once 'function_db_select.php';
    require_once 'function_db_update.php';

    $html = "hell0";
    function get_artist()
    {
        global $html;
        $array_result = get_array_artist();
        $html = "<table><tr><th>Nom de l'artiste</th><th>Biographie</th><th>Identifiant de vidéo Youtube</th><tr>";
        $html .= "<td>".$array_result['nameArtist']."<br/><a href=\"./administration.php?m=a&id=".$array_result['idArtist']."\">Modifier</a></td>";
        $html .= "<td>".$array_result['bio']."<br/><a href=\"./administration.php?m=b&id=".$array_result['idArtist']."\">Modifier</a></td>";
        $html .= "<td>".$array_result['magicCookieYoutube']."<br/><a href=\"./administration.php?m=mgcy&id=".$array_result['idArtist']."\">Modifier</a></td>";
        $html .= "</tr></table>";
    }

    function get_comment()
    {
        global $html;
        $array_result = get_array_comment();
        $user = get_User_by_id($array_result['idUser'])['pseudo'];
        $html = "<table><tr><th>Commentaire</th><th>Auteur</th><th>Valider</th><tr>";
        $html .= "<td>".$array_result['content']."</td>";
        $html .= "<td>".$user."</td>";
        $html .= "<td><a href=\"administration.php?idc=".$array_result['idComment'].";valid=1\">Oui</a>/<a href=\"administration.php?idc=".$array_result['idComment']."valid=0\">Non</a></td>";
        $html .= "</tr></table>";
    }

    function modify_artist($mdify, $id)
    {
        global $html;
        $array_result = get_array_artist();
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
        modify_artist_db($_REQUEST['type'],$_REQUEST[$_REQUEST['type']],$_REQUEST['id']); //TODO: Requête sans erreur mais pas de modification
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
                    <li class="nav-tabs li"><a href="artiste.php">Artiste</a></li>
                    <li class="nav-tabs li"><a href="index.php">Acceuil</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <div class="jumbotron">
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
