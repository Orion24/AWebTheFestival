<?php
/*
* Auteur : Bertrand Nicolas
* Date : 27.11.2015
* Version : 0.8
* Note : J'ai décidé de faire l'ajout dans une page à part car la fonction sera appellée à deux endroits différent
 */
    require_once './functionDb/function_db_insert.php';
    function add_comment($content, $idUser, $id, $type)
    {
      switch ($type) {
        case 'a':
          insert_comment_artist($idUser, $id, $content);
          break;
        case 's':
          insert_comment_schedule($idUser, $id, $content);
          break;
        default:
          throw new Exception("Pas de type correct définis");
          break;
        }
    }
