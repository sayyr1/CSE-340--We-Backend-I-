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
function navigationCreator($carClassification){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($carClassification as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
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

