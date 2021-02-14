<?php 
  require_once('database.php');
  
  $itemNum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);
  $title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);

  if (!isset($itemNum)){
    $itemNum = filter_input(INPUT_POST, 'ItemNum',FILTER_VALIDATE_INT);
    if ($itemNum == NULL||$itemNum == FALSE){
      $itemNum = 1;
    }
  }
 
  $queryListItem = 'SELECT * FROM todoitems';
  $statement1 = $db->prepare($queryListItem);
  $statement1->execute();
  $listItems = $statement1->fetchAll();
  $statement1->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <script src="https://kit.fontawesome.com/fb49eda623.js" crossorigin="anonymous"></script>
  <title>To Do List</title>
</head>
<body>
  <div class="container">
    <h1>ToDo List</h1>
    <div class="add">
      <!-- add todo form -->
      <h2>Add Item</h2>
      <form action="add_item.php" method="post">
      <div class="input_items">
        <input type="text" placeholder="Title" id="title" name="title">
        <input type="text" placeholder="Description" id="description" name="description">
      </div>
      <button type="submit">Add Item</button>
      </form>
    </div>
    <!-- todo item list -->
    <div class="list">
      <!-- generating list -->
      <?php foreach ($listItems as $listItem): ?> 
        <ul>
          <div class="list-items">
            <li class="title"> <?php echo $listItem['Title']; ?> </li>
            <li class="description"> <?php echo $listItem['Description']; ?> </li>
          </div>

          <li class="delete_button">
            <form action="delete_item.php" method="post">
              <input type="hidden" name="ItemNum" value="<?php echo $listItem['ItemNum'];?>">
              <button type="submit"><i class="far fa-trash-alt"></i></button>
            </form>
          </li>
        </ul>
      <?php endforeach; ?>
    </div>
    <footer>Humphrey Sui, Qiupeng - INF653 Assignment Week 4</footer>
  </div>
</body>
</html>