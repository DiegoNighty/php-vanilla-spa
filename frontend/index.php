<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LyricNote - El Sitio Web Para Recomendar Música!</title>
    <link rel="stylesheet" href="style/global.css">
</head>
<body id="page">
<div id="app">
    <?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    include_once 'app.php';
    ?>
</div>
</body>
<script>
    window.addEventListener("load", () => {
        const bannerNode = document.querySelector('[alt="www.000webhost.com"]').parentNode.parentNode;
        bannerNode.parentNode.removeChild(bannerNode);
    });
</script>
<script src="dom.controller.js"></script>
</html>