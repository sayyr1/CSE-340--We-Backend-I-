<!Doctype html>
<html lang="en-us">

<head>
    <title>PHP Motors</title>
    <meta name="viewport" content="width=device-width, initial-scale maximum-scale=1">

    <!--STYLE SHEETS-->
    <link  href="./css/style.css" rel="stylesheet">
    <!--FONTS LINKS-->
</head>


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
        <section class="welcome">
            <h1>Welcome to PHP Motors!</h1>
            <div class="sponsor">
                <p>
                    <strong>DMC Delorean</strong><br>
                    3 Cup holders<br>
                    Superman doors<br>
                    Fuzzy dice!
                </p>
            </div>

            <div class="car">
                <img src="/phpmotors/images/vehicles/delorean.jpg" alt="car_main">
            </div>
            <div class="own-today">
                <img src="/phpmotors/images/site/own_today.png" alt="buttom_i">
            </div>
        </section>
    </main>

    <!-- Aside -->
    <aside>
        <section class="reviews">
            <h2>DMC Delorean Reviews</h2>
            <ul>
                <li>"So fast its almost like traveling in time." (4/5)</li>
                <li>"Coolest ride on the road." (4/5)</li>
                <li>"I'm feeling Marty McFly!" (5/5)</li>
                <li>"The most futuristic ride of our day!" (4.5/5)</li>
                <li>"80's livin and I love it!" (5/5)</li>
            </ul>
        </section>
        <section class="upgrades">
            <h2>Delorean Upgrades</h2>
            <div>
                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux_caption">
                <a href="#">Flux Capacitor</a>
            </div>
            <div>
                <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame_decals">
                <a href="#">Flame Decals</a>
            </div>
            <div>
                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper_stickers">
                <a href="#">Bumper Stickers</a>
            </div>
            <div>
                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub_caps">
                <a href="#">Hub Caps</a>
            </div>
        </section>
    </aside>

    <!-- Footer -->
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'
        ?>
    </footer>
<script src="./js/links.js"></script>
</body>


</html>