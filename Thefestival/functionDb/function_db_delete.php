<?php
    /*
    * Auteur : Bertrand Nicolas
    * Date : 27.11.2015
    * Version : 0.8
     */
    require_once 'connectDb.php';

    function delete_user($id)
    {
      $query = getDb()->prepare("DELETE FROM `festival`.`users` WHERE `users`.`idUser` = :id");
      $query->bindParam(':id', $id, PDO::PARAM_INT);
      $query->execute();
    }
