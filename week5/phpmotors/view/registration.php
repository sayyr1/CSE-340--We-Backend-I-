<!Doctype html>
<html lang="en-us">

<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link href="/phpmotors/css/main.css" rel="stylesheet">
    <!--FONTS LINKS-->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Trispace:wght@100;500&display=swap" rel="stylesheet"> -->
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
    <main>
        <section class="login register">
            <h1 class="login-title register-title">Register</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/accounts/index.php" method="post">
                <fieldset class="login register">
                    <label>First Name </label> 
                    <input type="text" name="clientFirstname" id="clientFirstname">
                    <label>Last Name </label>
                    <input type="text" name="clientLastname">
                    <label>Email</label>
                    <input type="email" placeholder="someone@mail.com" name="clientEmail">
                    <label class="password">Password
                        <input type="password" name="clientPassword" id="password">
                        <i class="far fa-eye" id="togglePassword">view password</i>
                    </label>
                    <p class="instructions">Password must be at least 8 characters and contains at least 1 number, 1 capital letter and 1 special character.
                    </p>
                    <input class="submitBtn" type="submit" value="Register">
                    <!-- Add the action name - value pair-->
                    <input type="hidden" name="action" value="register">
                </fieldset>
            </form>
        </section>
    </main>

    <!-- Aside -->
   

    <!-- Footer -->
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
        ?>
    </footer>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', (e) => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // this.classList.toggle('fa-eye-slash')
        })
    </script>
</body>


</html>