<div class="header">
        <img class="logo" src="http://localhost/phpmotors/images/site/logo.png" alt="logo_php_motors">
        <!-- <a  href="/phpmotors/view/login.php?user=&user=" title="Login">My Account</a> -->
        <?php
        if (isset($_SESSION['loggedin'])){

                $link = $_SESSION['clientData']['clientId'];
        echo "<a id='client' class='my-account' href='/phpmotors/accounts/index.php'>Welcome " . $_SESSION['clientData']['clientFirstname'] ."</a>";
         
         echo '<a class="my-account" href="/phpmotors/accounts/index.php?action=Logout">Log-out</a>';
       
        } else {

        echo "<a class='my-account' href='/phpmotors/accounts/index.php?action=login'>My Account</a>";
        }

        ?>
 </div>