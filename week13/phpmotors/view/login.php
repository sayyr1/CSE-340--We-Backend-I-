<!Doctype html>
<html lang="en-us">

<head>
    <link rel="shortcut icon" href="images/scoot.ico">
    <title>PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">
    <!--STYLE SHEETS-->
    <link rel="stylesheet" href="../css/style.css">
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
            <form action="/phpmotors/accounts/index.php" method="post">
                <h1 class="login-title">Sing In</h1>

                <fieldset class="login">
                <label>Username</label>
                    <input type="email" placeholder="someone@mail.com" name="clientEmail"
                    <?php if(isset($clientEmail))
                    {echo "value='$clientEmail'";}
                    ?>
                    required>

                    <label class="password">Password
                        <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        <i class="far fa-eye" id="togglePassword">view password</i>
                    </label>
                    <input class="submitBtn" type="submit" value="Sing-in">
                    <input type="hidden" value="Login" name="action">
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