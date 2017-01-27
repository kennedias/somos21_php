<?php

include("includes/db_connector.php");

if(isset($_POST["submit"])){
  $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
  $password = $_POST["password"];
  
  $query = "SELECT * FROM user WHERE email='$email'";
  $result = $connection->query($query);

  if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $stored_password = $row["password"];
    echo "<p>password $stored_password, pass screen: $password </p>";
    $username = $row["username"];
    $userid = $row["id"];

    if(password_verify($password,$stored_password)){
      session_start();
      $_SESSION["user"]=array("username"=>$username,"email"=>$email,"userid"=>$userid);
      header('Location: profile.php');
    }
    else{
      echo "<p>email or password does not match our records</p>";
    }
  }
}
?>
<!doctype html>
<html>
    <?php include("includes/head.php");?>
    <body>
    <?php include("includes/navigation.php");?>
    <div class="login">
      <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <h2>Login</h2>
              <form action="login.php" method="post">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success" name="submit" value="login">Login</button>
                </div>
              </form>
            </div>       
         </div>
      </div>
    </div>
    <?php include("includes/footer.php");?>
    </body>
</html>