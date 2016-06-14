<?php
// Config
include __DIR__."/config.php";

// Enumérations
include __DIR__."/enums.php";

// Entities
include __DIR__."/entities/UserType.php";
include __DIR__."/entities/User.php";

include __DIR__."/entities/Distributor.php";
include __DIR__."/entities/Category.php";
include __DIR__."/entities/Lot.php";
include __DIR__."/entities/Product.php";
include __DIR__."/entities/ProductionMode.php";
include __DIR__."/entities/Shelf.php";
include __DIR__."/entities/Zonage.php";
include __DIR__."/entities/Order.php";
include __DIR__."/entities/OrderProduct.php";

// Manager
include __DIR__."/manager/AbstractPdoManager.php";

include __DIR__."/manager/PdoUserTypeManager.php";
include __DIR__."/manager/PdoUserManager.php";

include __DIR__."/manager/PdoDistributorManager.php";
include __DIR__."/manager/PdoLotManager.php";
include __DIR__."/manager/PdoProductionModeManager.php";
include __DIR__."/manager/PdoProductManager.php";
include __DIR__."/manager/PdoShelfManager.php";
include __DIR__."/manager/PdoCategoryManager.php";
include __DIR__."/manager/PdoZonageManager.php";
include __DIR__."/manager/PdoOrderManager.php";
include __DIR__."/manager/PdoOrderProductManager.php";

?>