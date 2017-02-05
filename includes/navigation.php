    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="logocontainer">
            <a class="" href="index.php">
              <img alt="logo" class="rounded logo" src="img/S21_brand.png">
            </a>
          </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php
              if($_SESSION["user"]){
                include("includes/logged.php");
              }
              else {
                include("includes/inputlogin.php");
              }
            ?>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    
    
    