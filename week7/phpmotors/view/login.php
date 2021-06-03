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
        <section class="login">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="get">
                <h1 class="login-title">Sing In</h1>

                <fieldset class="login">
                    <label>Username
                    <input type="email" name="user" placeholder="username"<?php if (isset($clientEmail)) { echo "value='$clientEmail'";}?> required> </label>

                    <label>Password
                        <input id="password" type="password" name="user" placeholder="password"  pattern="(?=^.{8,}$)(?=.*\d)(?!*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        <i class="far fa-eye" id="togglePassword">view password</i>
                        <p class="instructions">Password must be at least 8 characters and contains at least 1 number, 1 capital letter and 1 special character.
                        </p>
                    </label>
                    <input class="submitBtn" type="submit" value="Sing-in">
                    <input type="hidden" value="Login">
                </fieldset>

            </form>

        </section>
        <div class="not-register">
            Not register yet?<a class="not-register" href="/phpmotors/accounts/index.php?action=registration">Register</a>
        </div>
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