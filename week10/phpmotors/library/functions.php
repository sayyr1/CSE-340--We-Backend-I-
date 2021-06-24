<?php
function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Fuction for check the correct pattern of a password
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    
    return preg_match($pattern, $clientPassword);
}

// Function for check the correct pattern of the numbers of the Stock in add-vehicle model
function checkStock($invStock){
    $pattern = '/^\d+$/';
    return preg_match($pattern, $invStock);
}


// Function for check the correct pattern of the numbers of the Price in add-vehicle model
function checkPrice($invPrice)
{
    $pattern = '/^([0-9]*[.])?[0-9]+$/';
    return preg_match($pattern, $invPrice);
}


// function for the var menu
function navigationCreator($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
 $classificationList = '<select name="classificationId" id="classificationList">'; 
 $classificationList .= "<option>Choose a Classification</option>"; 
 foreach ($classifications as $classification) { 
  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
 } 
 $classificationList .= '</select>'; 
 return $classificationList; 
}

// This function will build a display of vehicles within an unordered list.
function buildVehicleDisplay($vehicles){
$dv = '<ul id="inv_display">';
foreach($vehicles as $vehicle){
    $numbers = $vehicle['invPrice'];
    $numbers = number_format($numbers);
    $dv .= '<li><a href="/phpmotors/vehicles/?action=details&invId='.urlencode($vehicle['invId']).'">';
    $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<span>$$numbers</span>";
    $dv .= '</a>';
    $dv .= '</li>';
}
$dv .= '</ul>';
return $dv;

}

// This function will display the vehicle Information
function buildInformationDisplay($vehicleInformation){
$numbers = $vehicleInformation['invPrice'];
$numbers = number_format($numbers);

 $dv = '<div class="detail-container">';   
 $dv .= "<img class='detail-img' src='$vehicleInformation[invImage]' alt='Image of $vehicleInformation[invMake] $vehicleInformation[invModel] on phpmotors.com'>";
 $dv .= "<p class='detail-price'>$$numbers</p>";
 $dv .= '<div>';
 $dv .= "<p><strong>$vehicleInformation[invMake] $vehicleInformation[invModel] Information:</strong></p>";
 $dv .= "<p>$vehicleInformation[invDescription]</p>";
 $dv .= "<p class='detail-color'>Color: $vehicleInformation[invColor]</p>";
 $dv .= "<p class='detail-stock'>Stock: $vehicleInformation[invStock]</p>";
 $dv .= '</div>';
 $dv .= '</div>';
 return $dv;
}

