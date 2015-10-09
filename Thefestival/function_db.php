<?php
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
            $dbb = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS);
            $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $dbb;
}
