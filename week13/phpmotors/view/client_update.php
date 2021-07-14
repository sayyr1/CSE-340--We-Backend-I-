<?php if($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location:/phpmotors/');
} ?>
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
        <section class="add">
            <h1>Manage Account</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <p><strong>Update Account</strong></p>
            <form action="/phpmotors/accounts/index.php" method="post">
            <fieldset class="login register add">

                    <label>First Name 
                    <input type="text" name="clientFirstname" id="clientFirstname"
                    <?php if(isset($clientFirstname))
                    {echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) { echo "value='$clientInfo[clientFirstname]'";}
                    ?> required></label>

                    <label>Last Name 
                    <input type="text" name="clientLastname" 
                    <?php if(isset($clientLastname))
                    {echo "value='$clientLastname'";}  elseif(isset($clientInfo['clientLastname'])) { echo "value='$clientInfo[clientLastname]'";}
                    ?> required></label>

                    <label>Email
                    <input type="email" placeholder="someone@mail.com" name="clientEmail"
                    <?php if(isset($clientEmail))
                    {echo "value='$clientEmail'";}  elseif(isset($clientInfo['clientEmail'])) { echo "value='$clientInfo[clientEmail]'";}
                    ?>
                    required></label>
                    <input type="submit" name="submit" value="Update Info" class="submitBtn vehicle_submit">
                    <input type="hidden" name="action" value="updateClient">
                    <input type="hidden" name="clientId" value="
                    <?php if(isset($clientInfo['clientId'])) { echo $clientInfo['clientId'];}
                    elseif(isset($clientInfo['clientId'])) { echo $clientId; }
                    ?>
                    " >
                   
                </fieldset>
            </form>

            </section>
            <section>
            <h3>Password Update</h3>
            <?php
            if (isset($message2)) {
                echo $message2;
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="post">
                <fieldset class="login register add">

                <label class="password">Password
                        <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        <i class="far fa-eye" id="togglePassword">view password</i>
                    </label>

                    <p class="instructions">Password must be at least 8 characters and contains at least 1 number, 1 capital letter and 1 special character.
                    </p>

                    <input type="submit" name="submit" value="Update Password" class="submitBtn vehicle_submit">
                    <input type="hidden" name="action" value="passwordUpdate">
                    <input type="hidden" name="clientId" value="
                    <?php if(isset($clientInfo['clientId'])) { echo $clientInfo['clientId'];}
                    elseif(isset($clientInfo['clientId'])) { echo $clientId; }
                    ?>
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
    <script src="../js/view_password.js"></script>
</body>

</html>