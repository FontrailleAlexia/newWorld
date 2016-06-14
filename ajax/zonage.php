<?php
include "../inc/main.php";


$array = array();

$q = strtolower($_GET["term"]);
$q = preg_replace('/\'/', " ", $q);

if(strlen($q) > 0){

  $result = $zonageManager->search($q);
  foreach ($result as $zonage) {

    $label =  $zonage->getPostalcode() . ' (' . $zonage->getCity() . ')';
    array_push($array, [
    	'postalcode' => $zonage->getPostalcode(), 
    	'city' => $zonage->getCity(),
    	'label' => $label
    	]);
  }
}

echo json_encode($array);