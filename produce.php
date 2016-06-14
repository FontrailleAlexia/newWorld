<?php
include "inc/main.php";

// Pas connecté
if(!$userManager->isConnected()){
	header('location: login.php'); 
	die;
}

// Vérification d'un compte "Producteur"
if($_SESSION['userType'] != Enum::USER_PRODUCER){
	header('location: profile.php'); 
	die;
}

$fields = $lotManager->getFields();
$products = $productManager->findAll();
$productionModes = $productionModeManager->findAll();
$pointsOfSale = $distributorManager->findAll();
$isSuccess = false;

if(count($_POST) == count($fields)){
	if($lotManager->add()){
		$_MSG_INFO = "Le lot a bien été ajouté.";
		$isSuccess = true;
	}else if($_MSG_ERROR == ""){
		$_MSG_ERROR = "L'ajout du lot a échoué.<br>";
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
		<title>Produire</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-md-6 col-md-offset-3 margin-top-05-percent">
					<div class="panel panel-info">
						<div class="panel-heading"> 
							<h3 class="panel-title">Ajout d'un lot</h3> 
						</div> 
						<div class="panel-body">
							<form method="POST" class="form-horizontal">
							  <div class="form-group">
							    <label for="product" class="col-sm-3 control-label">Sélectionner un produit</label>
							    <div class="col-sm-9">
									<select class="form-control" id="product" name="product">
										<?php foreach ($products as $product) {
											$id = $product->getId();
											$libelle = $product->getLibelle();?>

											<option value="<?php echo $id;?>" <?php if($_POST['product'] == $id) echo "selected";?> >
												<?php echo $libelle;?>
											</option>
										<?php }?>
									</select>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="quantity" class="col-sm-3 control-label">Quantité</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm spinner" id="quantity" name="quantity" placeholder="Quantité du lot" value="<?php echo $_POST['quantity'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="harvestDate" class="col-sm-3 control-label">Date de récolte</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm datepicker" id="harvestDate" name="harvestDate" placeholder="Entrez la date de récolte" value="<?php echo $_POST['harvestDate'];?>" readonly>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="daysPreserve" class="col-sm-3 control-label">Durée de conservation</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm spinner" id="daysPreserve" name="daysPreserve" placeholder="Entrez la durée de conservation" value="<?php echo $_POST['daysPreserve'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="productionMode" class="col-sm-3 control-label">Mode de production</label>
							    <div class="col-sm-9">
									<select class="form-control input-sm" id="productionMode" name="productionMode">
										<?php foreach ($productionModes as $mode) {
											$id = $mode->getId();
											$libelle = $mode->getLibelle();?>

											<option value="<?php echo $id;?>" <?php if($_POST['productionMode'] == $id) echo "selected";?> >
												<?php echo $libelle;?>
											</option>
										<?php }?>
									</select>
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="price" class="col-sm-3 control-label">Prix du lot</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control input-sm spinner" step="0.01" id="price" name="price" placeholder="Entrez le prix du lot" value="<?php echo $_POST['price'];?>">
							    </div>
							  </div>

							  <div class="form-group">
							    <label for="pointOfSale" class="col-sm-3 control-label">Point de vente</label>
							    <div class="col-sm-9">
									<select class="form-control input-sm" id="pointOfSale" name="pointOfSale">
										<?php foreach ($pointsOfSale as $pointOfSale) {
											$id = $pointOfSale->getId();
											$libelle = $pointOfSale->getLibelle();?>

											<option value="<?php echo $id;?>" <?php if($_POST['pointOfSale'] == $id) echo "selected";?> >
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