<?php
require_once 'connectDb.php';
function get_comment()
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
