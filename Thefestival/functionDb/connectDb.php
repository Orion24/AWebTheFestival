<?php
    /*
    * Auteur : Bertrand Nicolas
    * Date : 27.11.2015
    * Version : 0.8
     */
    DEFINE('DB_HOST', "127.0.0.1");
    DEFINE('DB_NAME', "festival");
    DEFINE('DB_USER', "userFestival");
    DEFINE('DB_PASS', "SuperUser");
    function getDb()
    {
        static $dbb = null;

        if($dbb === null)
        {
            try
            {
                $dbb = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $dbb;
    }
