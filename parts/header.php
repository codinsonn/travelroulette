<html lang="en">
<head>
    <?php
        $shortUrl = "http://goo.gl/D4Q2eT";
        $url = "http://student.howest.be/thorr.stevens/20152016/MAIII/TRAVELROULETTE/";
        $img = "http://student.howest.be/thorr.stevens/20152016/MAIII/TRAVELROULETTE/img/cover.png";
        $title = "Travel Roulette";
        $description = "By GAdventures";
    ?>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/screen.min.css">
    <meta property="og:url" content="<?php echo $url; ?>"/>
    <meta property="og:image" content="<?php echo $img; ?>"/>
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:site_name" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?php echo $description; ?>"/>
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/swing.js"></script>
    <script src="js/vendor/imagesloaded.js"></script>
    <script src="js/vendor/masonry.js"></script>
    <script src="js/app.min.js"></script>
</head>
<body>
    
    <!-- Page Container -->
    <div id="container">

        <!-- Header -->
        <header>
            <nav class="bgBar headerBgBar">
                <header><h1>Navigation</h1></header>
            </nav>
            <h1 class="logoWrapper"><a class="logoGTravelRoulette" href="?p=home"><span>TravelRoulette</span></a></h1>
        </header>
        <!-- / Header -->