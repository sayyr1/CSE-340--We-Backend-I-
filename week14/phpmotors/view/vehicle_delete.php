<?php if($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location:/phpmotors/');
} // Select list
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
    <title><?php if (isset($invInfo['invMake'])){ 
        echo "Delete $invInfo[invMake] $invInfo[invModel]";}
    ?> | PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link rel="stylesheet" href="../css/style.css">
   
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
            <h1 class="login-title register-title"><?php if (isset($invInfo['invMake'])){ 
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
}
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

                    <label for="invMake">Vehicle Make</label>
                    <input type="text" id="invMake" name="invMake" readonly
                    <?php if(isset($invInfo['invMake'])) { echo "value='$invInfo[invMake]'";}?>
                    required><br>

                    <label for="invModel">Vehicle Model</label>
                    <input type="text" id="invModel" name="invModel" readonly
                    <?php if(isset($invInfo['invModel'])) { echo "value='$invInfo[invModel]'";}?>
                     required><br>

                    <label for="invDescription">Description</label>

                    <textarea id="invDescription" name="invDescription" readonly required>
                    <?php if(isset($invInfo['invDescription'])) { echo "$invInfo[invDescription]";}?></textarea><br>

                    <input type="submit" name="submit" value="Delete Vehicle" class="submitBtn vehicle_submit">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])) { echo $invInfo['invId'];}
                    ?>">
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