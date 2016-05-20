<?php
require_once "config.php";
$q = strtolower($_GET["term"]);
if (!$q) return;

$q = preg_replace('/\'/', " ", $q);

$sql = "SELECT CP.*, DEP.*, REG.*
            FROM    code_postal AS CP
	          	INNER JOIN departement AS DEP ON substr(CP.cp, 1, 2) = DEP.NUMDEPT
          		INNER JOIN region      AS REG ON DEP.NUMREGION = REG.NUMREGION
          		WHERE      CP.cp LIKE '$q%'
          		ORDER BY CP.cp
											 LIMIT 12	
											";
$rsd = mysqli_query($laBase, $sql);

$array = array();
while ($rs = mysqli_fetch_array($rsd)) {
          $tmp_cp =  $rs['cp'] . ' (' . $rs['ville'] . ')  - ' . $rs['NOMDEPT'] . ' * ' . $rs['NOMREGION'];
          array_push($array, $tmp_cp); 
         }

echo json_encode($array);
?>