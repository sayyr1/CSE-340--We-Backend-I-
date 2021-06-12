<?php
// Create or access a Session
session_start();
// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicle model
require_once '../model/vehicle-model.php';

// Get the function library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();



// Navigation creator, calling the function navigationCreator

$navList = navigationCreator($classifications);



// Get the values from the action name - value pair
$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {
    case 'reg-classification':        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));


        // Filter the missing data
        if (empty($classificationName)) {
            $message = '<p id="alert" >Please provide information all empty form field.</p>';
            include '../view/add_classification.php';
            exit;
        }

        //  Send the data to the  model
        $regOutcome = insertClassification($classificationName);
                                                                                    
        // Check and report the result
        if ($regOutcome === 1) {
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p>Sorry, the $classificationName registration failed. Please try again.</p>";
            include '../view/add_classification.php';
            exit;
        }
        break;
    case 'reg-vehicle':
       // Filter the store the data
        $invMake          = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invDescription   = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invModel         = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invImage         = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail     = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice         = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock         = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor         = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

        $checkPrice = checkPrice($invPrice);
        $checkStock = checkStock($invStock);


        // Filter the missing data 
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice) || empty($checkStock) || empty($invColor) || empty($classificationId)){
            $message = '<p id="alert">Please provide information all empty form fields.</p>';
            include '../view/add_vehicle.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and result the result
        if ($regOutcome === 1) {
            $message = '<p id="alert">The vehicle has been register successfully.</p>';
            include "../view/add_vehicle.php";
            exit;
        } else {
            $message = '<p>Sorry, the registration failed. Please try again.</p>';
            include "../view/add-vehicle.php";
            exit;
        }
        break;
    
    case 'add-classification':
        include '../view/add_classification.php';
        break;
    case 'add-vehicle':
        include '../view/add_vehicle.php';
        break;    

    default:
        include "../view/vehicle_management.php";
        break;
}
