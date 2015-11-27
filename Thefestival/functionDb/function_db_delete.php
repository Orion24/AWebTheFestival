<?php
  require_once 'connectDb.php';

  function delete_user($id)
  {
    $query = getDb()->prepare("DELETE FROM `festival`.`users` WHERE `users`.`idUser` = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
  }
