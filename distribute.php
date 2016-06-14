<?php
include "inc/main.php";

// Pas connecté
if(!$userManager->isConnected()){
	header('location: login.php'); 
	die;
}

// Vérification d'un compte "Vendeur"
if($_SESSION['userType'] != Enum::USER_SELLER){
	header('location: profile.php'); 
	die;
}

$fields = $distributorManager->getFields();
$isSuccess = false;

if(count($_POST) == count($fields)){
	if($distributorManager->add()){
		$_MSG_INFO = "Le point de vente a bien été ajouté.";
		$isSuccess = true;
	}else if($_MSG_ERROR == ""){
		$_MSG_ERROR = "L'ajout du point de vente a échoué.<br>";
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
		<title>Distribuer</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-md-6 col-md-offset-3 margin-top-05-percent">
					<div class="panel panel-info">
						<div class="panel-heading"> 
							<h3 class="panel-title">Ajout d'un point de vente</h3> 
						</div> 
						<div class="panel-body">
							<form method="POST" class="form-horizontal">
							  <div class="form-group">
							    <label for="lastname" class="col-sm-3 control-label">Nom</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="lastname" name="lastname" placeholder="Nom du responsable" value="<?php echo $_POST['lastname'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="firstname" class="col-sm-3 control-label">Prénom</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="firstname" name="firstname" placeholder="Prénom du responsable" value="<?php echo $_POST['firstname'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="email" class="col-sm-3 control-label">Email</label>
							    <div class="col-sm-9">
							      <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Email professionnel" value="<?php echo $_POST['email'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="libelle" class="col-sm-3 control-label">Libellé</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="libelle" name="libelle" placeholder="Nom du point de vente" value="<?php echo $_POST['libelle'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="activity" class="col-sm-3 control-label">Activité pratiquée</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="activity" name="activity" placeholder="Supermarché, tabagiste..." value="<?php echo $_POST['activity'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="phone" class="col-sm-3 control-label">Téléphone</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="Téléphone de l'entreprise" value="<?php echo $_POST['phone'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="address" class="col-sm-3 control-label">Adresse</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="address" name="address" placeholder="Adresse de l'entreprise" value="<?php echo $_POST['address'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="address2" class="col-sm-3 control-label">Complèment d'adresse</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="address2" name="address2" placeholder="Complèment d'adresse de l'entreprise" value="<?php echo $_POST['address2'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="postalcode" class="col-sm-3 control-label">Code postal</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="postalcode" name="postalcode" placeholder="Code postal de l'entreprise" value="<?php echo $_POST['postalcode'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="city" class="col-sm-3 control-label">Ville</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm" id="city" name="city" placeholder="Ville de l'entreprise" value="<?php echo $_POST['city'];?>">
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