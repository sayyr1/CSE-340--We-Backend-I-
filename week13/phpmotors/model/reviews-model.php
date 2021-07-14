<?php 

//  Insert a review Function
function insertReview($reviewText, $clientId, $invId){
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, clientId, invId) VALUES (:reviewText, :clientId, :invId)';

    // Create the prepared statement using phpmotors connection.
    $stmt = $db->prepare($sql);

    // Store the information
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

    // Insert the data.
    $stmt->execute();

    // Ask how many rows changed as a result of our insert.
    $rowsChanged = $stmt->rowCount();

    // close the database interaction
    $stmt->closeCursor();

    // Return the indication of success(row-changed)
    return $rowsChanged;
}


//  Get reviews for a specific inventory item
function getReviews($invId){
    $db = phpmotorsConnect();
    $sql = "SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, reviews.invId, clients.clientFirstname, clients.clientLastname FROM reviews LEFT JOIN clients ON reviews.clientId = clients.clientId WHERE invId = :invId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

//  Get reviews written by a specific client
function getSpecificClient($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviews.reviewId, reviews.reviewDate, reviews.clientId, reviews.invId, inventory.invMake, inventory.invModel FROM reviews LEFT JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews; 
}


//  Get a specific review
function getEspecificReviews($reviewId){
    $db = phpmotorsConnect();
    $sql = "SELECT reviews.reviewId, reviews.reviewDate, reviews.reviewText, reviews.clientId, reviews.invId, inventory.invMake, inventory.invModel FROM reviews LEFT JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

//  Update a specific review
function updateReview($reviewText, $reviewId){
    $db =phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    
    // Create the prepared statement using phpmotors.
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholders in the SQL statement
    // with the actual values in the variables
    // and tells teh database the type of data it is.
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);


    // Insert data.
    $stmt->execute();

    // Ask how many rows changed as a result of our insert.
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction.
    $stmt->closeCursor();

    // Return the indication of success (row-changed).
    return $rowsChanged;
}

//  Delete a specific review
function deleteReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>