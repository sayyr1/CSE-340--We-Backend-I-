<?php if($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location:/phpmotors/');
} ?>
<?php
// Select list
$classificationList = '<select id="classificationId" name="classificationId" class="select">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)) {
        if($classification['classificationId'] == $classificationId){
            $classificationList .= ' selected ';
        }
    }
    elseif(isset($invInfo['classificationId'])){ 
        if($classification['classificationId'] === $invInfo['classificationId']){
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?>
<!Doctype html>
<html lang="en-us">
<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
        echo "Modify $invInfo[invMake] $invInfo[invModel]";}
        elseif(isset($invMake) && isset($invModel)){ 
            echo "Modify $invMake $invModel";
        }
        ?> | PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link href="/phpmotors/css/main.css" rel="stylesheet">
   
</head>

<!-- Body Here-->

<body>
    <!-- Header -->
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
        ?>
    </header>


    <!-- Navigation -->
    <nav>
        <?php echo $navList; ?>
    </nav>

    <!-- Main -->
    <main>
        <section class="add">
            <h1 class="login-title register-title"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
                echo "Modify $invInfo[invMake] $invInfo[invModel]";}
                elseif(isset($invMake) && isset($invModel)){ 
                    echo "Modify$invMake $invModel";}
                ?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <fieldset class="login register add">

                  <label for="classificationId">Choose a Car:</label>
                  
                    <?php echo $classificationList ?><br>

                    <label for="invMake">Make</label>
                    <input type="text" id="invMake" name="invMake" 
                    <?php if (isset($invMake)) { echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) { echo "value='$invInfo[invMake]'";}?>
                    required><br>

                    <label for="invModel">Model</label>
                    <input type="text" id="invModel" name="invModel"
                    <?php if (isset($invModel)) { echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) { echo "value='$invInfo[invModel]'";}?>
                     required><br>

                    <label for="invDescription">Description</label>

                    <textarea id="invDescription" name="invDescription"
                     placeholder="Add a description" required>
                     <?php if (isset($invDescription)){echo "$invDescription";} elseif(isset($invInfo['invDescription'])) { echo "$invInfo[invDescription]";}?></textarea><br>
                    
                    <label for="invImage">Image Path</label>
                    <input type="text" id="invImage" name="invImage"
                    <?php if (isset($invImage)) { echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) { echo "value='$invInfo[invImage]'";}?>
                    value="/phpmotors/image/no-image.png" required><br>

                    <label for="invThumbnail">Thumbnail Path</label>
                    <input type="text" id="invThumbnail" name="invThumbnail" 
                    <?php if (isset($invThumbnail)) { echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) { echo "value='$invInfo[invThumbnail]'";}?>
                    value="/phpmotors/images/no-image.png" required><br>

                    <label for="invPrice">Price</label>
                    <input type="text" id="invPrice" name="invPrice" pattern="[+-]?([0-9]*[.])?[0-9]+"
                    <?php if (isset($invPrice)) { echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) { echo "value='$invInfo[invPrice]'";}?> 
                    required><br>

                    <label for="invStock">Stock</label>
                    <input type="number" id="invStock" name="invStock" 
                    <?php if (isset($invStock)) { echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) { echo "value='$invInfo[invStock]'";}?>
                      required><br>

                    <label for="invColor">Color</label>
                    <input type="text" id="invColor" name="invColor" 
                    <?php if (isset($invColor)) { echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) { echo "value='$invInfo[invColor]'";}?>
                    pattern="[a-zA-Z]{1,20}" required><br>

                    <input type="submit" name="submit" value="Update Vehicle" class="submitBtn vehicle_submit">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])) { echo $invInfo['invId'];}
                    elseif(isset($invInfo['invId'])) { echo $invId; }
                    ?>
                    " >
                </fieldset>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
        ?>
    </footer>

</body>


</html>