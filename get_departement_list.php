<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$q = preg_replace('/\'/', " ", $q);

$sql = "SELECT       DEP.*, REG.* 
            FROM          departement AS DEP
          		INNER JOIN region      AS REG ON DEP.NUMREGION = REG.NUMREGION
            WHERE       NOMDEPT LIKE '$q%'
          		ORDER  BY NOMDEPT";
$rsd = mysqli_query($laBase, $sql);

while ($rs = mysqli_fetch_array($rsd)) {
          $tmp_dep = strtoupper($rs['NOMDEPT']) . ' (' . $rs['NUMDEPT'] . ') - ' . $rs['NOMREGION'];
          echo "$tmp_dep \n";
         }
?>