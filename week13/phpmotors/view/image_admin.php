<?php if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
} ?>
<!Doctype html>
<html lang="en-us">

<head>
    <title>Image Management || PHP Motors</title>
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
        <section>
            <h1>Image Management</h1>

        </section>
        <section>
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>
            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
                <label>Upload Image:</label>
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
            <hr>

        </section>
        <section>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
        </section>
    </main>
    <!-- Footer -->
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
        ?>
    </footer>
</body>

</html>
<?php unset($_SESSION['message']) ?>