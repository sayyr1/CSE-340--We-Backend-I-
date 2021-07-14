<?php
// Accounts Controller
// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the account model
require_once '../model/accounts-model.php';

// Get the function library
require_once '../library/functions.php';

// Get the function library
require_once '../library/functions.php';

// Get the reviews model
require_once '../model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();



// Navigation creator, calling the function navigationCreator

$navList = navigationCreator($classifications);


// Get the values from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Control Structure
// These are codes to deliver the views
switch ($action) {
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model 
        $regOutcome = regClients($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p id='alert'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

        break;
    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);

        
        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
         $message = '<p id="alert">Please provide a valid email address and password.</p>';
         include '../view/login.php';
         exit;
        }
          
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
          $message = '<p id="alert">Please check your password and try again.</p>';
          include '../view/login.php';
          exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view   
        
        
        // GET THE REVIEW OF THE USERS
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $link = $_SESSION['clientData']['clientId'];
        $reviews = getSpecificClient($link);
        if(!count($reviews)){
            $clientReviews = "<p id='empty'>You don't have reviews.</p>"; 
        } else{
        $clientReviews = showClientsReviews($reviews);
        }
        /////////////////////////

        include '../view/admin.php';

        exit;
        break;
    case 'Logout':
        session_unset();
        session_destroy();
        setcookie('firstname', null, -1, '/');
        header('Location: /phpmotors/');
        exit;
        break;
    case 'mod':
            // GET the value of the second name - value pair.
            $clientId = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
            // Send the $invId variable into a function, get the information for that single vehicle.
            $clientInfo = getClientInformation($clientId);
            
           // Check $invInfo has any data. If not we will set an error message.
            if(count($clientInfo) < 1){
                $message = 'Sorry, no vehicle information could be found.';
            }
          //  We will call a view where data can be displayed.
            include '../view/client_update.php';
         break;    
    case 'updateClient':
           // Filter and store the data
           $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
           $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
           $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
           $clientEmail = checkEmail($clientEmail);
           $clientId = trim(filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT));

             // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p id="alert">Please provide information all empty form fields.</p>';
            include '../view/client_update.php';
            exit;
             }
           // Check if the email address is different than the one in the session.
           $existingEmail = checkExistingEmail($clientEmail);

           // Send the data to the model.
           $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

           $updatedValues = getClientInformation($clientId);
           // Check and show the results.
           if($updateResult === 1){
            $message = '<p id="alert">The client has been updated successfully.</p>';
            $_SESSION['message'] = $message; 
            $_SESSION['updated'] = TRUE;
            $_SESSION['clientData'] = $updatedValues;

            include "../view/admin.php";
            exit;  
           } else {
            $message = '<p>Sorry, the updating failed. Please try again.</p>';
            include "../view/admin.php";
            exit;
        }
       break;

    case 'passwordUpdate':
             // Filter and store the data
             $clientId = trim(filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT));
             $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
             $passwordCheck = checkPassword($clientPassword);


          // Run basic checks, return if errors
          if (empty($passwordCheck)) {
            $message2 = '<p id="alert">Please provide a valid password.</p>';
            include '../view/client_update.php';
            exit;
           }

           $updatedValues = getClientInformation($clientId);

          
            // Hashing Password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
             // Send the data to the model.
             $updateResult = updatePassword($hashedPassword,$clientId );
           
             

           //  $updatedValues = getClientInformation($clientId);
             // Check and show the results.
             if($updateResult === 1){
              $message = '<p id="alert">The client has been updated successfully.</p>';
              $_SESSION['message'] = $message; 
              $updatedValues = getClientInformation($clientId);
              include "../view/admin.php";
              exit;  
             } else {
              $message = '<p>Sorry, the updating failed. Please try again.</p>';
              include '../view/client_update.php';
              exit;
          }
         break;

   
    default:

     // GET THE REVIEW OF THE USERS
     $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
     $link = $_SESSION['clientData']['clientId'];
     $reviews = getSpecificClient($link);
     if(!count($reviews)){
         $clientReviews = "<p id='empty'>You don't have reviews.</p>"; 
     } else{
     $clientReviews = showClientsReviews($reviews);
     }
     

        include '../view/admin.php';
        exit;
};
