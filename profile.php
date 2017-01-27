<?php
session_start();
include("includes/db_connector.php");
if(!$_SESSION["user"]){
  header("location:index.php");
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
    <?php include("includes/navigation2.php");?>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h2><?php echo "$username"; ?> Profile</h2>
            <form action="profile.php" method="post">
              <div class="form-group">
                <label for="username">Name:</label>
                <input type="username" class="form-control" id="username" name="username" placeholder="Name" value="<?php echo htmlspecialchars($username); ?>" />
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" />
              </div>
              <div class="form-group">
                <label for="birth">Date of birth:</label>
                <input type="birth" class="form-control" id="birth" name="birth" placeholder="Enter date of birth" value="<?php echo htmlspecialchars($birth); ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Gender</label>
                <select class="form-control" name="gender">
                    <option value="">Choose a gender</option>
                    <option value="F" <?php if($gender == "F"){echo "selected";}?>>Female</option>
                    <option value="M" <?php if($gender == "M"){echo "selected";}?>>Male</option>
                </select>
              </div>  
              <div class="form-group">
                <label class="control-label">Nationality</label>
                <?php 
                  $querySelectNationality="SELECT id, nationality FROM nationality";
                  echo "<select class='form-control' name='nationality'>";
                  echo "<option value=''>Select nationality</option>";  
                  foreach ($connection->query($querySelectNationality) as $row){
                    if($row['id'] == $nationality_code){
                      echo "<option value=".$row['id']." selected>".$row['nationality']."</option>";
                    }else {
                    echo "<option value=".$row['id'].">".$row['nationality']."</option>";  
                    }
                  }
                  echo "</select>";
                ?>
              </div>
              <div class="form-group">
                <label for="location">Location:</label>
                <input type="location" class="form-control" id="location" name="location" placeholder="Enter actual location" value="<?php echo htmlspecialchars($location); ?>">
              </div>
              <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number"value="<?php echo htmlspecialchars($mobile); ?>">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success" name="submit" value="profile">Update Profile</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php include("includes/footer.php");?>
    </body>
</html>