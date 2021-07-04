<?php
// Vehicle model 

// For inserting classification and insert Vehicle 
function insertClassification($classificationName)
{
        // Create a connection object usign the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement
        $sql = 'INSERT INTO carclassification(classificationName)
VALUES (:classificationName)';
        // Create the prepared statement using phpmotors connection
        $stmt = $db->prepare($sql);

        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is 
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert 
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        // Return the indication of success(row changed)
        return $rowsChanged;
}



function insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
        // Create a connection object usign the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES(:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';

        // Create the prepared statement using phpmotors connection
        $stmt = $db->prepare($sql);

        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables 
        // and tells the database the type of data it is
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

        // Insert data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction 
        $stmt->closeCursor();

        // Return the indication of success(row-changed)
        return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
        $db = phpmotorsConnect(); 
        $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
        $stmt = $db->prepare($sql); 
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
        $stmt->execute(); 
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $inventory; 
       }
// Get vehicle information by invId
function getInvItemInfo($invId){
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
}    

// Function Update Vehicles

function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
        // Create a connection object usign the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement
        $sql =  'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';

        // Create the prepared statement using phpmotors connection
        $stmt = $db->prepare($sql);

        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables 
        // and tells the database the type of data it is
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);

        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

        // Insert data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction 
        $stmt->closeCursor();

        // Return the indication of success(row-changed)
        return $rowsChanged;
}

// Function Delete Vehicles

function deleteVehicle($invId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
       }


// Function: get vehicles by classification name.
function getVehiclesByClassification($classificationName){
        $db = phpmotorsConnect();
        $sql = 'SELECT inventory.invId, inventory.invMake, inventory.invModel, inventory.invPrice, images.imgPath 
        FROM inventory LEFT JOIN images ON inventory.invId = images.invId AND images.imgPath LIKE "%-tn%" AND images.imgPrimary = 1
        WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
       }
// Function: get Vehicle information by Id;
function getInformationById($invId){
        $db = phpmotorsConnect();
        $sql = 'SELECT inv.invId, inv.invMake, inv.invModel, inv.invDescription, inv.invStock, inv.invColor, inv.invPrice, img.imgPath 
        FROM inventory AS inv 
        LEFT JOIN images AS img ON inv.invId = img.invId AND img.imgPath NOT LIKE "%-tn%" AND img.imgPrimary = 1
        WHERE inv.invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
}        

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}
