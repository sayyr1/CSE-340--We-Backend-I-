<!Doctype html>
<html lang="en-us">
<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>Manage Account | PHP Motors</title>
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
            if (isset($message)) {
                echo $message;
            }
            ?>
            <?php
                $time = strtotime($specificReview['reviewDate']);
                $formate_time = date("j M, Y", $time);
                echo "<h1>" . "Delete" . " ". $specificReview['invMake'] ." ". $specificReview['invModel'] . "</h1>";
                echo "<p> <strong>" . "Review" . " ". "on "."$formate_time ".  "</strong></p>";
            ?>
            <div><p id="alert">Deletes cannot be undone. Are you sure you want to delete this review?</p></div>
            <form action="/phpmotors/reviews/index.php" method="post">
            <fieldset class="login register review-delete">

                    <label>Review Text 
                    <textarea  class="review-area delete-area" name="reviewText" id="reviewText" readonly><?php if(isset($reviewTex)){echo $reviewTex;} elseif(isset($specificReview['reviewText'])) { echo $specificReview['reviewText'];}?></textarea>
                    </label>
                    
                    <input type="submit" name="submit" value="Delete" class="submitBtn deleteBtn">
                    <input type="hidden" name="action" value="confirm-deletion">
                    <input type="hidden" name="reviewId" value="<?php if(isset($specificReview['reviewId'])) { echo $specificReview['reviewId'];}elseif(isset($specificReview['reviewId'])) { echo $reviewId; }
                    ?>" >
                   
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