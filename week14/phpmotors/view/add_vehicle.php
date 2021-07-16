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
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?>
<!Doctype html>
<html lang="en-us">
<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>Add-Vehicle || PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--FONTS LINKS-->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Trispace:wght@100;500&display=swap" rel="stylesheet"> -->
    <!--SOCIAL MEDIA LINKS-->
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
            <h1 class="login-title register-title">Add Vehicle</h1>
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
                    <?php if (isset($invMake)) { echo "value='$invMake'";}?>
                  required><br>

                    <label for="invModel">Model</label>
                    <input type="text" id="invModel" name="invModel"
                    <?php if (isset($invModel)) { echo "value='$invModel'";}?>
               required><br>

                    <label for="invDescription">Description</label>

                    <textarea id="invDescription" name="invDescription"
                     placeholder="Add a description" required><?php if (isset($invDescription)){echo "$invDescription";}?></textarea><br>
                     <label for="invImage">Image Path</label>
                    <input type="text" id="invImage" name="invImage"
                    <?php if (isset($invImage)) { echo "value='$invImage'";}?>
                  value="/phpmotors/image/no-image.png" required><br>

                    <label for="invThumbnail">Thumbnail Path</label>
                    <input type="text" id="invThumbnail" name="invThumbnail" 
                    <?php if (isset($invThumbnail)) { echo "value='$invThumbnail'";}?>
                  value="/phpmotors/images/no-image.png" required><br>

                    <label for="invPrice">Price</label>
                    <input type="text" id="invPrice" name="invPrice" pattern="[+-]?([0-9]*[.])?[0-9]+"
                    <?php if (isset($invPrice)) { echo "value='$invPrice'";}?> 
                      required><br>

                    <label for="invStock">Stock</label>
                    <input type="number" id="invStock" name="invStock" 
                    <?php if (isset($invStock)) { echo "value='$invStock'";}?>
                   required><br>

                    <label for="invColor">Color</label>
                    <input type="text" id="invColor" name="invColor" 
                    <?php if (isset($invColor)) { echo "value='$invColor'";}?>
                    pattern="[a-zA-Z]{1,20}" required><br>

                    <!-- <label for="classificationId">Classification Name</label><br>
                    input type="text" id="classificationId" name="classificationId"> -->

                    <input type="submit" name="submit" value="Add Vehicle" class="submitBtn vehicle_submit">
                    <input type="hidden" name="action" value="reg-vehicle">
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