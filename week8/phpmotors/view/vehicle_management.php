<?php if(($_SESSION['clientData']['clientLevel'] < 2) or (!isset($_SESSION['loggedin']))){
    header('Location:/phpmotors/');
} ?>
<!Doctype html>
<html lang="en-us">

<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link href="/phpmotors/css/main.css" rel="stylesheet">
    <!--FONTS LINKS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
   
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
        <section class="management_container">
            <h1>Vehicle Management</h1>
            <ul class="vehicles_links">
                <li><a href="/phpmotors/vehicles/?action=add-classification">Add Classifications</a></li>
                <li><a href="/phpmotors/vehicles/?action=add-vehicle">Add Vehicle</a></li>

            </ul>
        </section>
        
    </main>


    <!-- Footer -->
    <footer>
       <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
       ?>
    </footer>

</body>


</html>