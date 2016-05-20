<?php
require_once "config.php";

$q = strtolower($_GET["q"]);
if (!$q) return;

$q = preg_replace('/\'/', " ", $q);

$sql = "SELECT      fr 
            FROM         country 
            WHERE      fr LIKE '%$q%' 
          		ORDER BY fr";
$rsd = mysqli_query($laBase, $sql);

while ($rs = mysqli_fetch_array($rsd)) {
          $tmp_c = strtoupper($rs['fr']);
          echo "$tmp_c \n";
         }
?>