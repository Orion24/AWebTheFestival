<?php
    require_once 'function_db_select.php';

    $html = "hell0";
    /*function get_artist()
    {

    }*/

    function get_array_comment()
    {
        global $html;
        $array_result = get_comment();
        $user = get_User_by_id($array_result['idUser'])['pseudo'];
        $html = "<table><tr><th>Commentaire</th><th>Auteur</th><th>Valider</th><tr>";
        $html .= "<td>".$array_result['content']."</td>";
        $html .= "<td>".$user."</td>";
        $html .= "<td><a href=\"administration.php?idc=".$array_result['idComment'].";valid=1\">Oui</a>/<a href=\"administration.php?idc=".$array_result['idComment']."valid=0\">Non</a></td>";
        $html .= "</tr></table>";
    }
    if(!empty($_REQUEST['v']))
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
                get_array_comment();
            default :
              get_array_comment();
              break;
        }
    }
    else {
        get_array_comment();
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
                        <a href="#?v=a">
                            Administration artistes
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#?v=s">
                            Administration horaire
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#?v=u">
                            Administration utilisateurs
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#?v=c">
                            Administration commentaires
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
