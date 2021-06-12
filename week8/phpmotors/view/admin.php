<?php if(!isset($_SESSION['loggedin'])){
    header('Location:/phpmotors/index.php');
} ?><!Doctype html>
<html lang="en-us">

<head>
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
     <section>
     <h1><?php echo $_SESSION['clientData']['clientFirstname'];?></h1>
     <ul>
        <li> First Name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
        <li> Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
        <li> Email Address: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
     </ul>
     <?php 
      if($_SESSION['clientData']['clientLevel'] > 1){
       echo' <a class="my-account" href="/phpmotors/vehicles/index.php?action">Vehicle Management</a>';
      };
     ?>
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