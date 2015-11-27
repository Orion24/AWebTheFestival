<?php
    /*
    * Auteur : Bertrand Nicolas
    * Date : 27.11.2015
    * Version : 0.8
     */
    require_once 'connectDb.php';

    function get_user_info()
    {
      $query = 'SELECT pseudo, isAdmin, idUser FROM users';
      $answer = getDb()->query($query);//execute the query
      return $answer->fetchAll(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
    function get_array_comment()
    {
      $query = 'SELECT content, idUser, idComment FROM comment';
      $answer = getDb()->query($query);//execute the query
      return $answer->fetchAll(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
    function get_array_comment_artist($idArtist)
    {
      $request = getDb()->prepare('SELECT content, idUser, dateCommentaire FROM comment WHERE isArtist=1 AND idArtist=:idArtist');
      $request->bindParam(':idArtist', $idArtist, PDO::PARAM_INT);
      $request->execute();
      return $request->fetchAll(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }

    function get_idArtist_by_name($name)
    {
      $request = getDb()->prepare('SELECT idArtist FROM artists WHERE nameArtist = :name');
      $request->bindParam(':name', $name, PDO::PARAM_STR);
      $request->execute();
      return $request->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }

    function get_User_by_id($id)
    {
      $query = 'SELECT pseudo FROM users WHERE idUser = '.$id;
      $answer = getDb()->query($query);//execute the query
      return $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
    function login_user($pseudo, $mdp)
    {
      $request = getDb()->prepare('SELECT pseudo, idUser, isAdmin FROM users WHERE pseudo = :pseudo AND password = SHA1(:mdp)');
      $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
      $request->bindParam(':mdp', $mdp, PDO::PARAM_STR);
      $request->execute();
      return $request->fetch(PDO::FETCH_ASSOC);
    }
    function get_array_all_artist()
    {
      $query = 'SELECT nameArtist, bio, magicCookieYoutube, idArtist FROM artists';
      $answer = getDb()->query($query);//execute the query
      return $answer->fetchAll(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
    function get_array_artist_id($idArtist)
    {
      $request = getDb()->prepare('SELECT nameArtist, bio, magicCookieYoutube, idArtist FROM artists WHERE idArtist = :idArtist');
      $request->bindParam(':idArtist', $idArtist, PDO::PARAM_INT);
      $request->execute();
      return $request->fetch(PDO::FETCH_ASSOC);
    }
    function get_array_artist_name($name)
    {
        $request = getDb()->prepare('SELECT nameArtist, bio, magicCookieYoutube, idArtist FROM artists WHERE nameArtist = :nameArtist');
        $request->bindParam(':nameArtist', $name, PDO::PARAM_STR);
        $request->execute();
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    function get_name_artist($limit)
    {
      $request = getDb()->prepare('SELECT nameArtist FROM artists LIMIT :limitArtist');
      $request->bindParam(':limitArtist', $limit, PDO::PARAM_INT);
      $request->execute();
      return $request->fetchAll(PDO::FETCH_ASSOC);
    }
