<?php
// Create or access a Session
session_start();
// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicle model
require_once '../model/vehicle-model.php';

// Get the uploads model
require_once '../model/uploads-model.php';

// Get the uploads model
require_once '../model/reviews-model.php';

// Get the function library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();



// Navigation creator, calling the function navigationCreator

$navList = navigationCreator($classifications);



// Get the values from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
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
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice) || empty($checkStock) || empty($invColor) || empty($classificationId)) {
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

        /**
         * Get vehicles by classificationId
         * Used for starting Update & Delete process
         */
    case 'getInventoryItems':
        // Get classificationID
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    case 'mod':
        // GET the value of the second name - value pair.
        $invId = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
     
        // Send the $invId variable into a function, get the information for that single vehicle.
        $invInfo = getInvItemInfo($invId);
     
        // Check $invInfo has any data. If not we will set an error message.
        if(count($invInfo) < 1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        // We will call a view where data can be displayed.
        include '../view/vehicle_update.php';
        break;
    case 'updateVehicle':
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
         $invId            = trim(filter_input(INPUT_POST, 'invId',FILTER_SANITIZE_NUMBER_INT));
 
         $checkPrice = checkPrice($invPrice);
         $checkStock = checkStock($invStock);
 
         // Filter the missing data 
         if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice) || empty($checkStock) || empty($invColor) || empty($classificationId)) {
             $message = '<p id="alert">Please provide information all empty form fields.</p>';
             include '../view/add_vehicle.php';
             exit;
         }
 
         // Send the data to the model
         $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
 
         // Check and show the result
         if ($updateResult === 1) {
             $message = '<p id="alert">The vehicle has been updated successfully.</p>';
             $_SESSION['message'] = $message;
             include "../view/add_vehicle.php";
             exit;
         } else {
             $message = '<p>Sorry, the updating failed. Please try again.</p>';
             include "../view/add_vehicle.php";
             exit;
         }
        break;

    case 'del':
            // GET the value of the second name - value pair.
            $invId = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
            // Send the $invId variable into a function, get the information for that single vehicle.
            $invInfo = getInvItemInfo($invId);
            
            // Check $invInfo has any data. If not we will set an error message.
            if(count($invInfo) < 1){
                $message = 'Sorry, no vehicle information could be found.';
            }
            // We will call a view where data can be displayed.
            include '../view/vehicle_delete.php';
            exit;
        break;
        case 'deleteVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='notice'>Error: $invMake $invModel was not
            deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
            break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        // var_dump($vehicles);
        // exit;
        if(!count($vehicles)){
            $message = "<p id='alert'>Sorry, no $classificationName vehicles could be found.</p>";
        } else{
            $vehicleDisplay = buildVehicleDisplay($vehicles);
        }
        include '../view/classification.php';
        exit;
        break; 
    case 'details': 
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
     
        $vehicleInformation = getInformationById($invId);
        $vehicleImages = getThubnailImages($invId);
        if(!count($vehicleInformation)){
            $message = "<p>Sorry, no Information found.</p>";
        } else {
            $informationDisplay = buildInformationDisplay($vehicleInformation);
            $imagesDisplay = ImagesThumbnailDisplay($vehicleImages);
        }

        // DISPLAYING THE COMMENTS OF THE VEHICLES. 
        $reviews = getReviews($invId);
        if (!count($reviews)){
            $vehicleComments = "<p id='empty'>There is no reviews, be the first to add an review</p>";
        } else{
        $vehicleComments = showExistingReview($reviews);
        }



        include '../view/vehicle_detail.php';
        break;           
    default:
        $classificationList = buildClassificationList($classifications);
        include "../view/vehicle_management.php";
        break;
}
