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
     <h1><?php if (isset($_SESSION['loggedin'])){
     echo $_SESSION['clientData']['clientFirstname'];}

    //  elseif (isset($_SESSION['updated'])){
    //     echo $_SESSION['clientUpdated']['clientFirstname'];}
    
  
   ?>
           
           
           
            <span><?php echo $_SESSION['clientData']['clientLastname'] ?></span></h1>
     <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
    <?php 
        if($_SESSION){
            echo "<p>You are logged in.</p>";
        }
    ?>
     <ul>
        <li> First Name: <?php echo $_SESSION['clientData']['clientFirstname']; if(isset($clientInfo['clientFirstname'])) { echo $clientInfo['clientFirstname'];}?></li>
        <li> Last Name: <?php echo $_SESSION['clientData']['clientLastname']; if(isset($clientInfo['clientLastname'])) { echo $clientInfo['clientLastname'];}?></li>
        <li> Email Address: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
     </ul>
     </section>
     <div>
     <?php 
      if($_SESSION['clientData']['clientLevel'] > 1){
          $link = $_SESSION['clientData']['clientId'];
       echo" 
        <div>
             <h3>Account Management</h3>
             <p>use this link to update account information.</p>
             <a class='my-account' href='/phpmotors/accounts/index.php?action=mod&id=$link'>Account Management</a>
             
        </div>
        <div>
             <h3>Inventory Management</h3>
             <p>Use this link to manage the inventory.</p>
             <a class='my-account' href='/phpmotors/vehicles/index.php?action'>Vehicle Management</a>;
       </div>
    
       ";
      };
     ?>
    </div>
    </main>


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