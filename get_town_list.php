<?php
require_once "config.php";
$q = strtolower($_GET["term"]);
if (!$q) return;

$q = preg_replace('/`/', "", $q);
$q = preg_replace('/\'/', " ", $q);

$sql = "SELECT cp, ville, DEP.*, REG.*
            FROM    code_postal AS CP
          	JOIN departement AS DEP ON substr(CP.cp, 1, 2) = DEP.NUMDEPT
         		JOIN region           AS REG ON DEP.NUMREGION = REG.NUMREGION
           WHERE      ville LIKE '$q%' 
	         	ORDER BY ville
										 LIMIT 12	
										";
$rsd = mysqli_query($laBase, $sql);

$array = array();
while ($rs = mysqli_fetch_array($rsd)) {
          $tmp = $rs['ville'] . ' (' . $rs['cp'] . ') - ' . strtoupper($rs['NOMDEPT'] . ' * ' . $rs['NOMREGION']);
          array_push($array, $tmp); 
         }

echo json_encode($array);
?>