<?php 
  
  $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

  // check input
  if($title != FALSE AND $description != FALSE){
    require_once('database.php');
    
    $query = 'INSERT INTO todoitems
              (Title, Description)
              VALUES
              (:title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
    header('location: index.php');
    
  }else{
    include('index.php');
  }
  