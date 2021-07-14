<?php if(!isset($_SESSION['loggedin'])){
    header('Location:/phpmotors/index.php');
} ?>
<?php if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
} ?>
<!Doctype html>
<html lang="en-us">
<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>Review Updating | PHP Motors</title>
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
        <section class="delete-review-container">
            <?php
                $time = strtotime($specificReview['reviewDate']);
                $formate_time = date("j M, Y", $time);
                echo "<h1>" . $specificReview['invMake'] ." ". $specificReview['invModel'] . " "."Review on" ." ". $formate_time . "</h1>";

            ?>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/reviews/" method="post">
            <fieldset class="login register review review-delete">
                    <label>Review Text 
                    <textarea class="review-area" name="reviewText" id="reviewText" required><?php if(isset($reviewTex)){echo $reviewTex;} elseif(isset($specificReview['reviewText'])) { echo $specificReview['reviewText'];}?></textarea>
                    </label>
                    <input type="submit" name="submit" value="Update Review" class="submitBtn reviewBtn">
                    <input type="hidden" name="action" value="edit-review">
                    <input type="hidden" name="reviewId" value="
                    <?php if(isset($specificReview['reviewId'])) { echo $specificReview['reviewId'];}
                    elseif(isset($specificReview['reviewId'])) { echo $reviewId; }
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
<?php unset($_SESSION['message']) ?>