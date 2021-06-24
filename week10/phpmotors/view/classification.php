<!Doctype html>
<html lang="en-us">

<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title><?php echo $classificationName;?> vehicle | PHP Motors, Inc.</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--FONTS LINKS-->
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
        <section>
            <h1><?php echo $classificationName; ?> vehicles</h1>
            <?php if(isset($message)){
                echo $message;
            } ?>
            
            <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;
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