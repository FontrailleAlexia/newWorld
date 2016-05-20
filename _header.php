<?php
//inclusion de db.class.php
require "db.class.php";
$DB = new DB();
//inclusion de panier.class.php
require "panier.class.php";
$panier = new panier($DB);
?>
<head>
	<meta charset='utf8'>
	<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
</head>
<body>
	<?php include "header.php"; ?>

<div id="header">
	<div class="wrap">
		<div class="menu">
			<fieldset class="fieldset_panier">
			<ul class="panier">
				<li class="caddie"><a href="panier.php"><img class="image_panier" src="images/panier.png"></a></h1>
				<li class="Items">
					Quantité:
					<span><span id="count"><?php echo $panier->count(); ?></span></span>
				</li>
				<li>
					Total:
					<span><span id="total"><?php echo number_format($panier->total(),2,',',' '); ?></span></span>
				</li>
			</ul>
			</fieldset>
		</div>
	</div>
</div>

<? require "footer_rien.php" ?>