<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Game</title>
</head>
<body>
    <h1>The Game</h1>
    <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        require("class/Personnage.php");
        require("class/Orc.php");
        require("class/Humain.php");
        require("class/Elfe.php");
        require("class/GameEngine.php");

        
    ?>
</body>
</html>