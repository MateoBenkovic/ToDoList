<?php 

  include("baza.php");
  $bp=spojiSeNaBazu();

  if(!empty($active_user)){
    header("Location:index.php");
  }

  if(isset($_GET['logout'])){
    unset($_SESSION["active_user_id"]);
		unset($_SESSION["active_user"]);
		unset($_SESSION["active_user_name"]);
		session_destroy();
		header("Location:login.php");
	}

  $error= "";

	if(isset($_POST['submit'])){
		$username=mysqli_real_escape_string($bp,$_POST['username']);
		$password=mysqli_real_escape_string($bp,$_POST['password']);

		if(!empty($username) && !empty($password)){
			$sql="SELECT user_id, name, last_name, username, password, email FROM user WHERE username='$username' AND password='$password'";
			$rs=izvrsiUpit($bp,$sql);
			if(mysqli_num_rows($rs)==0)$error="Wrong username or password. Try again!";
			else{
				list($active_user_id, $name, $last_name, $username, $password, $email)=mysqli_fetch_array($rs);
				$_SESSION['active_user']=$username;
				$_SESSION['active_user_name']=$name." ".$last_name;
        $_SESSION['active_user_id']=$active_user_id;
				header("Location:index.php");
			}
		}
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

          <h1 class="main-caption">TODO App</h1>

        </div>

      </header>
    <div class="main">
      <div class="main-left">

        <h1 class="caption">Your Day <br> Perfectly Organised</h1>

      </div>
      <div class="main-right">
    
      <h1>LogIn</h1> 

      <form id="login" name="login" method="POST" action="login.php">

      <div class="login-input-grid">

        <div class="username">
          <label for="username">Username</label><br>
          <input class="username-input" name="username" id="username" type="text" required>
        </div>

        <div class="password">
          <label for="password">Password</label><br>
          <input class="password-input" type="password" name="password" id="password" required>
        </div>

        <div class="login-input">
          <input name="submit" type="submit" value="Log in" class="login">
        </div>

        <div class="error">
        
        <?php 

          if(!empty($error)){
            echo $error;
          }

        ?>

        </div>

        <div class="register-button">
          <text>Don't have an account?</text>
          <a href="signup.php" class="signup">Sign up</a>
        </div>

      </div>
      </form>

      </div>

      
      </div>

    </body>
  </html>