<?php
include "inc/main.php";

if($userManager->isConnected()){
	header('location: profil.php'); 
	die;
}

$fields = $userManager->getFields();
$userTypes = $userTypeManager->findAll();
$isSuccess = false;

if(count($_POST) == count($fields)){
	if($userManager->registration()){
		$_MSG_INFO = "L'inscription a réussi. Vous pouvez maintenant vous connecter.";
		$isSuccess = true;
	}else if($_MSG_ERROR == ""){
		$_MSG_ERROR = "L'inscription a échoué.<br>";
	}
}

// Initialise les champs
foreach ($fields as $field) {
	if(!isset($_POST[$field]) || $isSuccess) $_POST[$field] = '';
}
?>



<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8" />
		<?php include __DIR__."/parts/stylesheets.php";?>
		<title>Inscription</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-md-6 col-md-offset-3 margin-top-05-percent">
					<div class="panel panel-info">
						<div class="panel-heading"> 
							<h3 class="panel-title">Inscription</h3> 
						</div> 
						<div class="panel-body">
							<form method="POST" class="form-horizontal">
							  <div class="form-group">
							    <label for="lastname" class="col-sm-3 control-label">Nom</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="lastname" name="lastname" placeholder="Tapez votre nom" value="<?php echo $_POST['lastname'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="firstname" class="col-sm-3 control-label">Prénom</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="firstname" name="firstname" placeholder="Tapez votre prénom" value="<?php echo $_POST['firstname'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="email" class="col-sm-3 control-label">Email</label>
							    <div class="col-sm-9">
							      <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Tapez votre email" value="<?php echo $_POST['email'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="birthDate" class="col-sm-3 control-label">Date de naissance</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm datepicker" id="birthDate" name="birthDate" placeholder="Tapez votre date de naissance" value="<?php echo $_POST['birthDate'];?>" readonly>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="phone" class="col-sm-3 control-label">Téléphone</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="Tapez votre numéro de téléphone" value="<?php echo $_POST['phone'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="nickname" class="col-sm-3 control-label">Pseudo</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="nickname" name="nickname" placeholder="Tapez votre pseudo" value="<?php echo $_POST['nickname'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="address" class="col-sm-3 control-label">Adresse</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="address" name="address" placeholder="Tapez votre adresse" value="<?php echo $_POST['address'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="address2" class="col-sm-3 control-label">Complèment d'adresse</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="address2" name="address2" placeholder="Tapez votre complèment d'adresse" value="<?php echo $_POST['address2'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="postalcode" class="col-sm-3 control-label">Code postal</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="postalcode" name="postalcode" placeholder="Entrez votre code postal" value="<?php echo $_POST['postalcode'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="city" class="col-sm-3 control-label">Ville</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="city" name="city" placeholder="Entrez votre ville" value="<?php echo $_POST['city'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="password" class="col-sm-3 control-label">Mot de passe</label>
							    <div class="col-sm-9">
							      <input type="password" class="form-control input-sm" id="password" name="password" placeholder="Tapez votre mot de passe" value="<?php echo $_POST['password'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="retypePassword" class="col-sm-3 control-label">Retapez le mot de passe</label>
							    <div class="col-sm-9">
							      <input type="password" class="form-control input-sm" id="retypePassword" name="retypePassword" placeholder="Comfirmez votre mot de passe" value="<?php echo $_POST['retypePassword'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="type" class="col-sm-3 control-label">Type de compte</label>
							    <div class="col-sm-9">
									<select class="form-control" id="type" name="type">
										<?php foreach ($userTypes as $type) {
											$id = $type->getId();
											$libelle = $type->getLibelle();?>

											<option value="<?php echo $id;?>" <?php if($_POST['type'] == $id) echo "selected";?> >
												<?php echo $libelle;?>
											</option>
										<?php }?>
									</select>
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