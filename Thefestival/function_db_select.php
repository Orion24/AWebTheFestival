<?php
require_once 'connectDb.php';
function get_array_comment()
{
  $query = 'SELECT content, idUser, idComment FROM comment';
  $answer = getDb()->query($query);//execute the query
  return $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
}
function get_User_by_id($id)
{
  $query = 'SELECT pseudo FROM users WHERE idUser = '.$id;
  $answer = getDb()->query($query);//execute the query
  return $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
}
function get_array_all_artist()
{
  $query = 'SELECT nameArtist, bio, magicCookieYoutube, idArtist FROM artists';
  $answer = getDb()->query($query);//execute the query
  return $answer->fetchAll(PDO::FETCH_ASSOC);//We make the answer an associotive array
}
function get_array_artist($idArtist)
{
  $request = getDb()->prepare('SELECT nameArtist, bio, magicCookieYoutube, idArtist FROM artists WHERE idArtist = :idArtist');
  $request->bindParam(':idArtist', $idArtist, PDO::PARAM_INT);
  $request->execute();
  return $request->fetch(PDO::FETCH_ASSOC);
}
