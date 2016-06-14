<?php
include "../inc/main.php";

//Si le produit a dépassé la date limite
$lotManager->removeExpiredLots();