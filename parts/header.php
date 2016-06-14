<?php 
$url = $_SERVER['REQUEST_URI'];
if($url[strlen($url)-1] == "/")
  $url = substr($url, 0, strlen($url)-1);

$url = substr($url, strrpos($url, "/")+1);
$url = explode("?", $url)[0];
?>

<nav class="navbar navbar-inverse">
  <div class="navbar-first">
    <div class="container">
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <div class="navbar-header">
            France
          </div>

          <ul class="nav navbar-nav">
            <?php if(!$userManager->isConnected()){?>
              <li class="<?php echo ($url=="login.php") ? "active" : ""; ?>"><a href="login.php">Connexion</a></li>
              <li class="<?php echo ($url=="registration.php") ? "active" : ""; ?>"><a href="registration.php">Inscription</a></li>

            <?php }else{?>
              <li><a href="logout.php">Déconnexion</a></li>
              <li class="<?php echo ($url=="profile.php") ? "active" : ""; ?>"><a href="profile.php">Profil</a></li>
            <?php }?>

          </ul>

        </div>
      </div>
    </div>
  </div>

  <div class="navbar-second">
    <div class="container">
      <div class="col-md-9">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">NW</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

              <?php if($userManager->isConnected()){ // Si connecté à un compte
                // Compte "ACHETEUR"
                if($_SESSION['userType'] == Enum::USER_BUYER){?>
                  <li class="<?php echo ($url=="buy.php") ? "active" : ""; ?>"><a href="buy.php">Acheter</a></li>

              <?php // Compte "USER_PRODUCER"
                }else if($_SESSION['userType'] == Enum::USER_PRODUCER){?>
                  <li class="<?php echo ($url=="produce.php") ? "active" : ""; ?>"><a href="produce.php">Produire</a></li>

              <?php // Compte "VENDEUR"
                }else if($_SESSION['userType'] == Enum::USER_SELLER){?>
                  <li class="<?php echo ($url=="distribute.php") ? "active" : ""; ?>"><a href="distribute.php">Distribuer</a></li>
              <?php }?>

            <?php }?>
            </ul>
          </div>
      </div>

      <div class="col-md-3">
        <div class="search-bar">

          <div class="input-group input-group-xs">
            <input type="text" class="form-control" placeholder="Rechercher">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
          </div>

        </div>
      </div>
  </div>
  </div>
</nav>
