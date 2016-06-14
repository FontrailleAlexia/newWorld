<?php
header('Content-Type: application/json');

include "../inc/main.php";

$response = array("error" => true);
if (isset($_POST['nickname']) && 
    isset($_POST['lastname']) && 
    isset($_POST['firstname']) && 
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['retypePassword'])) {
 
    // recevoir les paramètres en POST
    $nickname = $_POST['nickname'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];

    // Inscription de l'utilisateur
    if ($userManager->insert() != false) {
        $response["error"] = false;

    } else {
        // pseudo ou mot de passe incorrect
        $response["error_msg"] = $_MSG_ERROR;
    }
} else {
    // paramètres POST manquants
    $response["error_msg"] = "Paramètres obligatoires!";
}

// Retourne la réponse en JSON
echo json_encode($response);