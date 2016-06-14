<?php
include "inc/main.php";

if(!$userManager->isConnected()){
	header('location: login.php');
	die;
}

$fields = array_merge(array_diff($userManager->getFields(), array("retypePassword")));
if(count($_POST) == count($fields)){
	if($userManager->update()){
		$_MSG_INFO = "Le profil a bien été enregistré.";
	}else if($_MSG_ERROR == ""){
		$_MSG_ERROR = "L'enregistrement a échoué.<br>";
	}
}

$user = $userManager->getUser();
?>

<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8" />
		<?php include __DIR__."/parts/stylesheets.php";?>
		<title>Profil</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-md-6 col-md-offset-3 margin-top-05-percent">
					<div class="panel panel-info">
						<div class="panel-heading"> 
							<h3 class="panel-title">Profil</h3> 
						</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal">
							  <div class="form-group">
							    <label for="lastname" class="col-sm-3 control-label">Nom</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="lastname" name="lastname" placeholder="Nom" value="<?php echo $user->getLastname();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="firstname" class="col-sm-3 control-label">Prénom</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="firstname" name="firstname" placeholder="Prénom" value="<?php echo $user->getFirstname();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="email" class="col-sm-3 control-label">Email</label>
							    <div class="col-sm-9">
							      <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Email" value="<?php echo $user->getEmail();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="birthDate" class="col-sm-3 control-label">Date de naissance</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm datepicker" id="birthDate" name="birthDate" placeholder="Date de naissance" value="<?php echo $user->getBirthDateString();?>" readonly>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="phone" class="col-sm-3 control-label">Téléphone</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="Téléphone" value="<?php echo $user->getPhone();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="nickname" class="col-sm-3 control-label">Pseudo</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="nickname" name="nickname" placeholder="Pseudo" value="<?php echo $user->getNickname();?>" readonly>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="address" class="col-sm-3 control-label">Adresse</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="address" name="address" placeholder="Adresse" value="<?php echo $user->getAddress();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="address2" class="col-sm-3 control-label">Complèment d'adresse</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="address2" name="address2" placeholder="Complèment d'adresse" value="<?php echo $user->getAddress2();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="postalcode" class="col-sm-3 control-label">Code postal</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="postalcode" name="postalcode" placeholder="Code postal" value="<?php echo $user->getPostalcode();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="city" class="col-sm-3 control-label">Ville</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="city" name="city" placeholder="Ville" value="<?php echo $user->getCity();?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="type" class="col-sm-3 control-label">Type de compte</label>
							    <div class="col-sm-9">
									<select class="form-control" id="type" name="type">
									  <option value="1" <?php if($user->getType() == 1) echo "selected";?> >
									  	Vendeur
									  </option>

									  <option value="2" <?php if($user->getType() == 2) echo "selected";?> >
									  	Acheteur
									  </option>

									  <option value="3" <?php if($user->getType() == 3) echo "selected";?> >
									  	Producteur
									  </option>
									</select>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="password" class="col-sm-3 control-label">Nouveau mot de passe</label>
							    <div class="col-sm-9">
							      <input type="password" class="form-control input-sm" id="password" name="password" placeholder="Nouveau mot de passe">
							    </div>
							  </div>

							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-success">Valider</button>
							    </div>
							  </div>

							</form>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php include __DIR__."/parts/footer.php";?>
		<?php include __DIR__."/parts/scripts.php";?>
	</body>
</html>