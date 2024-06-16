<?php 

  include("baza.php");
  $bp=spojiSeNaBazu();

  if(!empty($active_user)){
    header("Location:index.php");
  }

  if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="INSERT INTO user
    (name,last_name,email,username,password)
    VALUES 
    ('$name','$last_name','$email','$username','$password');
    ";

    $_SESSION['active_user']=$username;
    $_SESSION['active_user_name']=$name." ".$last_name;
    
    izvrsiUpit($bp,$sql);
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="hr">
  <head>
    <title>Todo List</title>
    <link rel="stylesheet" href="todoList.css">
  </head>

  <body>

    <header>

        <div class="middle-section">

          <h1 class="main-caption">TODO app</h1>

        </div>

      </header>

    <div class="main">

      <div class="main-left">

        <h1 class="caption">Your Day <br> Perfectly Organised</h1>

      </div>

      <div class="signup-main-right">

        <h1>Sign up</h1> 

      <form id="signup" name="signup" method="POST" action="signup.php">

      <div class="login-input-grid">

        <div class="name">
          <label for="name">Name</label><br>
          <input class="name-input" name="name" id="name" type="text" required>
        </div>

        <div class="last_name">
          <label for="last_name">Last name</label><br>
          <input class="last-name-input" name="last_name" id="last_name" type="text" required>
        </div>

        <div class="email">
          <label for="email">Email</label><br>
          <input class="email-input" name="email" id="email" type="email" required>
        </div>

        <div class="username">
          <label for="username">Username</label><br>
          <input class="username-input" name="username" id="username" type="text" required>
        </div>

        <div class="password">
          <label for="password">Password</label><br>
          <input class="password-input" type="password" name="password" id="password" required>
        </div>

        <div class="signup-input">
          <input name="submit" type="submit" value="Sign up" class="login">
        </div>
        
        <div class="login-button">
          <text>Already have an account?</text>
          <a href="login.php" class="signup">Log in</a>
        </div>

        </div>
        </form>
      </div>
    </div>

  </body>
</html>