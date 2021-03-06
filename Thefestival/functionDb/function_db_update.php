<?php
  /*
  * Auteur : Bertrand Nicolas
  * Date : 27.11.2015
  * Version : 0.8
   */
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
        default:
          throw new Exception("Pas de type correct définis");
          break;
    }
    $query = getDb()->prepare("UPDATE festival.artists SET ".$name_column." = :value WHERE artists.idArtist = :id;");
    $query->bindParam(':value', $value, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
  }

  function promote_user($id)
  {
    $query = getDb()->prepare("UPDATE festival.users SET isAdmin = 1 WHERE idUser = :id;");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
  }

  function accept_comment_db($idComment)
  {
    $query = getDb()->prepare("UPDATE festival.comment SET isValid = 1 WHERE idComment = :id;");
    $query->bindParam(':id', $idComment, PDO::PARAM_INT);
    $query->execute();
  }
