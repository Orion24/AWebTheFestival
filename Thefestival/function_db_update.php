<?php
  require_once 'connectDb.php';
  function modify_artist_db($type,$value,$id)
  {
    $name_column = "";
    switch ($type)
    {
        case 'a':
            $name_column = "nameArtist";
            break;
        case 'b':
            $name_column = "bio";
            break;
        case 'mgcy':
            $name_column = "magicCookieYoutube";
            break;
    }
    $query = getDb()->prepare("UPDATE festival.artists SET ".$name_column." = :value WHERE artists.".$name_column." = :id;");
    $query->bindParam(':value', $value, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
  }
