<?php if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
} ?>
<!Doctype html>
<html lang="en-us">

<head>
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
        <?php echo $navList; ?>
    </nav>

    <!-- Main -->
    <main class="main-detail">
        <section class="container">
            <h1 class="detail-header"><?php
                                        if (isset($vehicleInformation)) {
                                            echo $vehicleInformation['invMake'];
                                        }
                                        ?>
                <span>
                    <?php
                    if (isset($vehicleInformation)) {
                        echo $vehicleInformation['invModel'];
                    }
                    ?>
                </span>
            </h1>
            <?php if (isset($informationDisplay)) {
                echo $informationDisplay;
            }
            ?>
          
        </section>
        <?php
        echo $imagesDisplay;
        ?>
    </main>
    <hr>
    <article class="review-section">
        <h1>Customer Reviews</h1>

        <!-- This is for display the form if the client is logged in.-->
        <?php if(!isset($_SESSION['loggedin'])){
            echo '<div>
             <p>Do you want to write a review? Please Sing In.</p>
             <a class="my-account reviewBtn" href="/phpmotors/accounts/index.php?action=login">Sing In</a>
            </div>';
            } ?>

        <div>
            <h2 class="review-name">Review the 
                    <?php
                        if (isset($vehicleInformation)) {
                            echo $vehicleInformation['invMake'];
                    }?>
                <span>
                    <?php
                    if (isset($vehicleInformation)) {
                        echo $vehicleInformation['invModel'];
                    }
                    ?>
                </span>
            </h2>
            <?php
             if (isset($message)) {
                echo $message;
            }
            ?>

        </div>


        <div>
     <?php   if(isset($_SESSION['loggedin'])){
            $name = $_SESSION['clientData']['clientFirstname'];
            $lastname = $_SESSION['clientData']['clientLastname'];
            $initial_name = substr($name,0, 1);
            $id = $vehicleInformation['invId'];
            $client = $_SESSION['clientData']['clientId'];

         echo "<form action='/phpmotors/reviews/index.php' method='post'>
                <fieldset class='login register review'>
                <legend></legend>
                <label> Screen Name:
                <input class='user-name' value= '$initial_name$lastname' readonly>
                </label>
                <label>
                Review:
                <textarea class='review-area' name='reviewText' required></textarea>
                </label>
                <input type='submit' name='submit' value='add-review' class='submitBtn reviewBtn'>
                <input type='hidden' name='action' value='add-review' class='submitBtn vehicle_submit'>
                <input type='hidden' name='invId' value='$id'>
                <input type='hidden' name='clientId' value='$client'>

                </fieldset>
                </form>";

     }
        ?>
        </div>

        <div class="reviews">
       
          <?php
            if (isset($vehicleComments)) {
                echo $vehicleComments;
            } 
            ?>
    
        </div>


    </article>


    <!-- Footer -->
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
        ?>
    </footer>

</body>


</html>
<?php unset($_SESSION['message']) ?>