<?php 
  require_once('database.php');

  $itemNum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);

  if ($itemNum != FALSE){
    $query = 'DELETE FROM todoitems
              WHERE ItemNum = :itemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $itemNum);
    $statement->execute();
    $statement->closeCursor();
  }
  include('index.php');