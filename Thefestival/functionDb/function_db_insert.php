<?php
  /*
  * Auteur : Bertrand Nicolas
  * Date : 27.11.2015
  * Version : 0.8
   */
  require_once 'connectDb.php';
  function insertUser($pseudo, $pass)
  {
      $request = getDb()->prepare("INSERT INTO `festival`.`users` (`idUser`, `pseudo`, `password`, `isAdmin`) VALUES (NULL, :pseudo, SHA1(:pass), '0');");
      $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 25);
      $request->bindParam(':pass', $pass, PDO::PARAM_STR, 20);
      $request->execute();
  }

  function insert_artist($name, $bio, $mgcy)
  {
    $request = getDb()->prepare("INSERT INTO `festival`.`artists` (`idArtist`, `nameArtist`, `bio`, `magicCookieYoutube`) VALUES (NULL, :name, :bio, :mgcy);");
    $request->bindParam(':name', $name, PDO::PARAM_STR, 25);
    $request->bindParam(':bio', $bio, PDO::PARAM_STR, 400);
    $request->bindParam(':mgcy', $mgcy, PDO::PARAM_STR, 12);
    $request->execute();
  }

  function insert_comment_artist($idUser, $idArtist, $content)
  {
       $request = getDb()->prepare("INSERT INTO `festival`.`comment` (`idComment`, `idUser`, `idSchedule`, `idArtist`, `dateCommentaire`, `content`, `isArtist`) VALUES (NULL, ':idUser', '', ':idArtist', ':date', ':content', '1');");
       $request->bindParam(':content', $content, PDO::PARAM_STR, 200);
       $request->bindParam(':idArtist', $idArtist, PDO::PARAM_INT);
       $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
       $request->bindParam(':date', date("Y-m-j"), PDO::PARAM_STR);
       $request->execute();
  }
