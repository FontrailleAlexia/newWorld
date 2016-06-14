<?php
include "inc/main.php";

if($userManager->isConnected()){
	header('location: profile.php');
	die;
}

if(isset($_POST['pseudo'], $_POST['password'])){
	$user = $userManager->authenticateFromWeb($_POST['pseudo'], $_POST['password']);
	if($user == null)
		$_MSG_ERROR = "Le pseudo ou le mot de passe saisi est incorrect.";
	else{
		die;
	}
}
?>

<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8" />
		<?php include __DIR__."/parts/stylesheets.php";?>
		<title>Connexion</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-sm-6 col-sm-offset-4">
					<form action="login.php" method="post" class="form-signin">       
					    <div class="input-group">
					    	<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					    	<input class="form-control" name="pseudo" placeholder="Pseudo" id="pseudo" required="" autofocus="" type="text">
					    </div>

					    <div class="input-group">
					    	<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					    	<input class="form-control" name="password" id="password" placeholder="Mot de passe" required="" type="password">
					    </div>

					    <button type="submit" class="btn btn-labeled btn-success center-block">
					    	<span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>
					        Connexion
					    </button>   
					</form>
	        	</div>
			</section>
		</div>

		<?php include __DIR__."/parts/footer.php";?>
		<?php include __DIR__."/parts/scripts.php";?>
	</body>
</html>