<?php
    require_once './functionDb/function_db_select.php';
    $artists = "";
    $array_artist = get_name_artist(5);
    foreach ($array_artist as $value)
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
                    <li class="nav-tabs li"><a href="artiste.php">Artiste</a></li>
                    <li class="nav-tabs li"><a href="inscription.php">Inscription</a></li>
                    <li class="nav-tabs li"><a href="administration.php">Admin</a></li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" placeholder="Pseudo" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Connexion</button>
                    <input type="button" onclick="location.href='inscription.php';" value="Inscription" class="btn btn-default"/>
                </form>
            </nav>
        </header>
        <div class="container">
            <div class="jumbotron">
                    Bonjour
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
                    <li class="sidebar-brand">
                        <a href="#">Jours</a>
                    </li>
                    <li>Lundi</li>
                    <li>Mardi</li>
                </ul>
            </div>
            <div class="comment">
                    Bonjour
            </div>
        </div>
    </body>
</html>
