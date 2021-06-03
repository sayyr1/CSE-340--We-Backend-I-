<!Doctype html>
<html lang="en-us">

<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link href="/phpmotors/css/main.css" rel="stylesheet">
    <!--FONTS LINKS-->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Trispace:wght@100;500&display=swap" rel="stylesheet"> -->
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
        <section class="adding_classification">
            <h1 class="login-title register-title">Add Classifications</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form class="adding_classification_form" action="/phpmotors/vehicles/index.php" method="post">
                <label for="classificationName">Classification Name</label><br>
                <input type="text" id="classificationName" name="classificationName" 
                <?php if (isset($classificationName)) { echo "value='$classificationName'";}?>
                placeholder="Add the new classification." pattern="[A-Za-z]{1,50}" required>

                <input type="submit" name="submit" class="submitBtn" value="Add Classification">
                <!-- Add teh action name -value pair-->
                <input type="hidden" name="action" value="reg-classification">
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