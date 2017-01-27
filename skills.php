<?php
session_start();
include("includes/db_connector.php");
if(!$_SESSION["user"]){
  header("location:login.php");
  exit();
} else{
  $s_userid=$_SESSION["user"]["userid"];
}

if($_POST["submit"]=="profile"){
  $username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
  $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
  $nationality_code = $_POST["nationality"];
  $location = $_POST["location"];
  $birth = $_POST["birth"];
  $mobile = $_POST["mobile"];
  $picture = $_POST["picture"];
  $gender = $_POST["gender"];
  $password = $_POST["password"];

  $queryUpdateUser="UPDATE user SET username='$username', nationality_code='$nationality_code',email='$email', location='$location', birth='$birth', mobile='$mobile', gender='$gender' WHERE id=$s_userid";
  $resultUpdateUser =$connection->query($queryUpdateUser);
  
  if($resultUpdateUser->num_rows>0){
    echo '<h3>rows affected: $resultUpdate->num_rows</h3>';
  } 
}else{
  $querySelectUser = "SELECT username, nationality_code, location, email, birth, gender, mobile, picture FROM user where id='$s_userid'";  
  $resultSelectUser =$connection->query($querySelectUser);

  if($resultSelectUser->num_rows>0){
    while($row=$resultSelectUser->fetch_assoc()){
      $id=$row["id"];
      $username = $row["username"];
      $nationality_code = $row["nationality_code"];
      $location = $row["location"];
      $email = $row["email"];
      $birth = $row["birth"];
      $mobile = $row["mobile"];
      $picture = $row["picture"];
      $gender = $row["gender"];
    }
  }
}

?>

<!doctype html>
<html>
    <?php include("includes/head.php");?>
    <body>
    <?php include("includes/navigation.php");?>
    <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <h2><?php echo "$username"; ?> Skills</h2>
              <form action="skills.php" method="post">
                <div class="container">
                	<div class="row">
                		<input type="hidden" name="count" value="1" />
                        <div class="control-group" id="fields">
                            <label class="control-label" for="field1">Add or remove your skills</label>
                            <div class="controls" id="profs"> 
                                <form class="input-append">
                                    <div id="field">
                                        <input autocomplete="off" class="input" id="field1" name="prof1" type="text" placeholder="Skill description" data-items="8"/><button id="b1" class="btn add-more" type="button">+</button></div>
                                </form>
                                <br>
                            </div>
                        </div>
                	</div>
                </div>
              </form>
            </div>
          </div>
      </div>
    
      <?php include("includes/footer.php");?>
    </body>
</html>