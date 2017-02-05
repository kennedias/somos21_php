<?php

session_start();
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
        $_SESSION["user"]=array("username"=>$username,"email"=>$email,"userid"=>$userid);
        header('Location: index.php');
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

        <div class="jumbotron">
          <div class="container">
            <h1>Somos21</h1>
              <p>Bringing professionals together across Australia and Latin America to build networks, foster professional development, and explore business opportunities.</p>
            <p><a class="btn btn-primary btn-lg" href="join.php" role="button">Join</a></p>
          </div>
        </div>
    
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <h3>Connection, Growth and Opportunity</h3>
              <p>Providing a collaborative environment to generate ideas, action and opportunities.</p>
              <p><a class="btn btn-default" href="http://somos21.org/ourmission" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-3">
              <h3>Repositioning and Awareness</h3>
              <p>Raising the profile of Latin America as a source and destination region for talented professionals.</p>
              <p><a class="btn btn-default" href="http://somos21.org/ourmission" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-3">
              <h3>Advocacy</h3>
              <p>Being a trusted representative for our members to government and industry.</p>
              <p><a class="btn btn-default" href="http://somos21.org/ourmission" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-3">
              <h3>Social Impact</h3>
              <p>Proactively promoting and driving opportunities for social enterprise.</p>
              <p><a class="btn btn-default" href="http://somos21.org/ourmission" role="button">View details &raquo;</a></p>
            </div>
          </div>
    
          <hr>
        </div> <!-- /container -->
        <?php include("includes/footer.php");?>
    </body>
</html>