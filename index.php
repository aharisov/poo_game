<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Game</title>
</head>
<body>
    <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        require("class/Personnage.php");
        require("class/Orc.php");
        require("class/Humain.php");
        require("class/Elfe.php");
        require("class/GameEngine.php");

        //------------- duel start ---------------------------
        
        // array for stocking duelist
        $domeDuTonnere = [
            new Orc("Loïc"), 
            new Humain("Yanick")
        ];

        echo "<h2>Le duel commence</h2>";

        // make attacks while all duelists are alive
        while ($domeDuTonnere[0]->pv > 0 && $domeDuTonnere[1]->pv > 0) {
            
            // change attacker every time
            foreach($domeDuTonnere as $index => $perso) {
                
                $cible = $index == 0 ? 1 : 0;
                
                echo $perso->attaquer($domeDuTonnere[$cible], true);
                
            }

        }
        //-------------- duel end ----------------------------

        //------------- game engine start ---------------------------
        echo "<h2>La bataille commence</h2>";

        $game = new GameEngine();
        $game->addCombattant(new Humain("Loic")); 
        $game->addCombattant(new Orc("Yannick"));
        $game->addCombattant(new Elfe("Jonathan"));
        $game->addCombattant(new Humain("Test1"));
        $game->addCombattant(new Elfe("Test2"));
        $game->addCombattant(new Orc("Test3"));
        $game->addCombattant(new Orc("Test4"));
        $game->addCombattant(new Elfe("Test5"));

        $game->start();

        //var_dump($game->getJoueur());
        //------------- game engine finish --------------------------
    ?>
</body>
</html>