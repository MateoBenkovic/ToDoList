<?php 

  include("baza.php");
  $bp=spojiSeNaBazu();

?>

<?php 
  $sql = "SELECT user_id FROM user WHERE username = '$active_user'";
  $result = izvrsiUpit($bp, $sql);
  $active_user_id = mysqli_fetch_column($result);

  $sql = "SELECT * FROM todo_items WHERE todo_items.user_id = $active_user_id ORDER BY date ASC";
  $result = izvrsiUpit($bp,$sql);

  if(isset($_POST['submit'])){
    $todo_name = mysqli_real_escape_string($bp, $_POST['todo_name']);
		$date = mysqli_real_escape_string($bp, $_POST['todo_date']);

    if(!empty($todo_name) && !empty($date)){
      $sql = "INSERT INTO todo_items 
      (user_id, todo_name, date, finished)
      VALUES
      ('$active_user_id', '$todo_name', '$date', '0')";
    }

    izvrsiUpit($bp,$sql);
    header("Location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="hr">
  <head>
    <title>
      TODO List
    </title>

    <link  type="text/css" rel="stylesheet" href="todoList.css">

  </head>

    <body>

      <header>

        <div class="middle-section">

          <h1 class="main-caption">TODO app</h1>

        </div>

        <div class="right-section">

          <p class="user">
            <?php 
              
                echo 'Welcome ' . $active_user . '<br>
                <a href="login.php?logout=1" class="logout">Log out</a>';
              
            ?>
          </p>

        </div>

      </header>

      <div class="main">

        <div class="todo-list">

          <h1 style="margin-left: 7px;">Todo list</h1>


          <form id="add_todo" name="add_todo" method="POST" action="index.php">
            <div class="todo-input-grid">

              <input name="todo_name" id="todo_name" class="textbox" placeholder="Todo name" required>

              <input name="todo_date" id="todo_date" type="datetime-local" class="date" required>

              <input name="submit" type="submit" class="addToList" value="Add TODO">

            </div>

          </form>

          

          <div class="js-todo-list todo-grid">
          
            <?php 
            
              while(list($user_id, $todo_id, $todo_name, $date, $finished) = mysqli_fetch_array($result)){
                $date = date("d.m.Y. H:i:s", strtotime($date));
                echo "<div class='todo-name'>$todo_name</div>

                      <div class='todo-date'>$date</div>";

                      if($finished == 0) {
                        echo "<a href='update_todo.php?todo_id=$todo_id' class='finished'>Finish</a>";
                      } else {

                        echo "<a class='finished-todo'>Done</a>";
                      }

                        echo 
                        "<a href='delete_todo.php?todo_id=$todo_id' class='delete'>
                          Delete</a>";
              }
            
            ?>
          
           </div>
         </div>
        </div>
      </div>

      <script type="module" src="todo.js"></script>

    </body>
  
</html>