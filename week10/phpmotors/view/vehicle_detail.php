<!Doctype html>
<html lang="en-us">

<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--FONTS LINKS-->
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
      <?php echo $navList;?>
    </nav>

    <!-- Main -->
    <main>
        <section class="container">
            <h1 class="detail-header"><?php 
            if(isset($vehicleInformation)){
             echo $vehicleInformation['invMake']; 
            }
            ?>
            <span>
            <?php 
            if(isset($vehicleInformation)){
             echo $vehicleInformation['invModel']; 
            }
            ?>
            </span>
            </h1>
            <?php if(isset($informationDisplay)){
                echo $informationDisplay;
            }
            ?>
        </section>
    </main>


    <!-- Footer -->
    <footer>
       <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
       ?>
    </footer>

</body>


</html>