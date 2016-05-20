<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$q = preg_replace('/\'/', " ", $q);

$sql = "SELECT      NOMREGION
            FROM         region  
            WHERE      NOMREGION LIKE '%$q%'
          		ORDER BY NOMREGION";
$rsd = mysqli_query($laBase, $sql);

while ($rs = mysqli_fetch_array($rsd)) {
          $tmp_region = strtoupper($rs['NOMREGION']);
          echo "$tmp_region \n";
         }
?>