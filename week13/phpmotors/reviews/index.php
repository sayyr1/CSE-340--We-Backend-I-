<?php
/**
 * ----------------------------
 *  REVIEWS CONTROLLER
 * ------------------------------
 */
// Access to the session 
session_start();

// Outside resources
// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicle model
require_once '../model/vehicle-model.php';

// Get the uploads model
require_once '../model/uploads-model.php';

// Get the reviews model
require_once '../model/reviews-model.php';

// Get the function library
require_once '../library/functions.php';

// Build the nav list

// Get array from the classifications
$classifications = getClassifications();

// Navigation creator, calling the function navigationCreator
$navList = navigationCreator($classifications);

// Collect the "action" value from the "post" or "get" options of the "request" from the browser.
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
// Control Structure
switch ($action) {
    case 'add-review':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        // Filter the missing data.
        if (empty($reviewText)) {
            $message = '<p>Error</p>';

        }
        else{
        // Send the data to the model.
        $regOutcome = insertReview($reviewText, $clientId, $invId);
        }

        if ($regOutcome) {
            $message = '<p id="alert">Thanks for the review. It is displayed below.</p>';

        } else {
            $message = '<p id="alert">Sorry the review is not uploaded. Check if the textarea is empty.</p>';
        }

         // Store message to session
         $_SESSION['message'] = $message;

         header("location: /phpmotors/vehicles/?action=details&invId=$invId");
         break;



    case 'review-handler':
        // GET the value of the second name - value pair.
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        // Send the $invId variable into a function, get the information for that single vehicle.
        $specificReview = getEspecificReviews($reviewId);

        // Check $invInfo has any data. If not we will set an error message.
        if (count($specificReview) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        //  We will call a view where data can be displayed.
        include '../view/review_update.php';

        break;



    case 'edit-review':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

        // Checking for missing data.
        if (empty($reviewText)) {
            $message = '<p id="alert">Please provide information all empty form fields.</p>';
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/reviews/index.php?action=review-handler&id=$reviewId");
            exit;
        }

        // Send the data to the model.
        $updatingReview = updateReview($reviewText, $reviewId);


        // Check if the updating happened.
        if ($updatingReview === 1) {
            $message = '<p id="alert">The review has been updated successfully.</p>';
        } else {
            $message = '<p id="alert">Sorry, the updating failed. Please try again.</p>';
        }

        $_SESSION['message'] = $message;


        header('location: .');



        // We will call a view where data can be displayed.
    case 'deletion-handler':
        // GET the value of the second name - value pair.
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        // Send the $invId variable into a function, get the information for that single vehicle.
        $specificReview = getEspecificReviews($reviewId);

        // Check $invInfo has any data. If not we will set an error message.
        if (count($specificReview) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        //  We will call a view where data can be displayed.
        include '../view/delete_review.php';

        break;

    case 'confirm-deletion':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);
        var_dump ( $reviewId);
        $deleteResult = deleteReview($reviewId);

        if($deleteResult){
            $message = "<p id='alert'>The review has been successfully deleted.</p>";
            $_SESSION['message'] = $message;

            include '../view/admin.php';
        } else{
            $message = "<p>Error.</p>";
         
        }
        $_SESSION['message'] = $message;

        header('location: .');
        break;




    default:
        // Get the review name and id.
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $link = $_SESSION['clientData']['clientId'];
        $reviews = getSpecificClient($link);
        if(!count($reviews)){
            $clientReviews = "<p id='empty'>You don't have reviews.</p>"; 
        } else{
        $clientReviews = showClientsReviews($reviews);
        }

        // Call the function to obtain the reviews.

        include '../view/admin.php';
        exit;
}
