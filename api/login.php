<?php
header('Content-Type: application/json');

include "../inc/main.php";

$response = array("error" => true);

if (isset($_GET['nickname']) && isset($_GET['password'])) {
 
    // recevoir les paramètres en POST
    $nickname = $_GET['nickname'];
    $password = $_GET['password'];
 
    // obtenir l'utilisateur par le pseudo et le mot de passe via notre userManager
    $user = $userManager->authenticateFromApi($nickname, $password);
    if ($user != false) {
        // l'utilisateur existe
        $response["user"]["id"] = $user->getId();
        $response["user"]["firstname"] = $user->getFirstname();
        $response["user"]["lastname"] = $user->getLastname();
        $response["user"]["email"] = $user->getEmail();
        $response["user"]["birthdate"] = $user->getBirthDateString();
        $response["user"]["phone"] = $user->getPhone();
        $response["user"]["nickname"] = $user->getNickname();
        $response["user"]["address"] = $user->getAddress();
        $response["user"]["address2"] = $user->getAddress2();
        $response["user"]["postalcode"] = $user->getPostalcode();
        $response["user"]["city"] = $user->getCity();
        $response["user"]["type"] = $user->getType();
        $response["error"] = false;

    } else {
        // pseudo ou mot de passe incorrect
        $response["error_msg"] = "Le pseudo ou le mot de passe saisi est incorrect.";
    }
} else {
    // paramètres POST manquants
    $response["error_msg"] = "Paramètres obligatoires: pseudo ou mot de passe manquant!";
}

// Retourne la réponse en JSON
echo json_encode($response);