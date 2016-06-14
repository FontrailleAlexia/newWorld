<?php
include "inc/main.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<?php include __DIR__."/parts/stylesheets.php";?>
		<title>New World</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-md-5 margin-top-10-percent welcome">
					<p class="text-center">
						Les meilleurs produits de saison.<br>
						Du producteur à l'artisan et au consommateur<br>
						Ni usine, ni camion, ni grande surface<br>
					</p>
					<p class="text-center">
						La terre et l'homme à nouveau respectés<br>
						New World
					</p>
				</div>

				<div class="col-md-3 pull-right">
					<div class="row">
						<img src="images/boucher.jpg" width="200" alt="Boucher" />
					</div>

					<div class="row margin-top-10">
						<img src="images/jardinier.jpg" width="200" alt="Jardinier" />
					</div>
				</div>
			</section>
		</div>

		<?php include __DIR__."/parts/footer.php";?>
		<?php include __DIR__."/parts/scripts.php";?>
	</body>
</html>