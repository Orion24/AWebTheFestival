<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
                        <a href="#">
                            Artistes
                        </a>
                    </li>
                    <li>AC/DC</li>
                    <li>Avenged Sevenfold</li>
                    <li>Distubed</li>
                    <li>Five finger Death Punch</li>
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