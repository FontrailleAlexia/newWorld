<?php
include "autoload.php";

$userTypeManager = new PdoUserTypeManager();
$userManager = new PdoUserManager();

$distributorManager = new PdoDistributorManager();
$lotManager = new PdoLotManager();
$productionModeManager = new PdoProductionModeManager();
$productManager = new PdoProductManager();
$shelfManager = new PdoShelfManager();
$categoryManager = new PdoCategoryManager();
$zonageManager = new PdoZonageManager();
$orderManager = new PdoOrderManager();
$orderProductManager = new PdoOrderProductManager();

$_MSG_WARNING = "";
$_MSG_ERROR = "";
$_MSG_INFO = "";