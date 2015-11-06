<?php
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
