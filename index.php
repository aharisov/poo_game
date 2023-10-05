<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Game</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/styles.css?time=<?php echo time();?>">
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
        require("class/Duel.php");

        //------------- game engine start ---------------------------
        /*
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
        */
        //var_dump($game->getJoueur());
        //------------- game engine finish --------------------------
    ?>

    <main class="flex justify-center items-center ">
        <div class="game-container <?php if (!$_GET) echo 'justify-center';?> border-double border-4 rounded-lg border-indigo-600">
            
            <?php if (!$_GET) {?>
                
                <h1 class="text-5xl mb-10 ">Faites votre choix !</h1>

                <div class="flex justify-center max-w-5xl">
                    <a href="?game=duel" class="border-2 rounded-lg mr-5 p-5 border-purple-600 bg-purple-600 hover:bg-purple-800 text-lg uppercase text-white">commencer un duel</a>
                    <a href="?game=battle" class="border-2 rounded-lg p-5 border-rose-600 hover:bg-rose-800 bg-rose-600 text-lg uppercase text-white">commencer une bataille</a>
                </div>
                
            <?php } else {
             
                        if ($_GET && $_GET["game"] == "duel") {
                            
                            $domeDuTonnere = [
                                Personnage::generatePersonnage(), 
                                Personnage::generatePersonnage()
                            ];

                            echo '<h1 class="text-5xl mb-10 ">Le duel commence !</h1>';
                            echo "<div class='battle-field'>";
                            echo Personnage::showPersonnage($domeDuTonnere[0]);
                            echo Personnage::showPersonnage($domeDuTonnere[1]);
                            
                            echo "<div class='field-inner'>";
                            Duel::startDuel($domeDuTonnere);
                            echo "</div>";

                            echo "</div>";

                            echo '<a href="?game=duel" class="border-2 rounded-lg absolute p-5 border-purple-600 bg-purple-600 hover:bg-purple-800 text-lg uppercase text-white" style="bottom: 3em">commencer un nouvel duel</a>';
                            echo '<a href="http://localhost/poo_thegame/" class="return-home border-2 rounded-lg p-5 border-rose-600 hover:bg-rose-800 bg-rose-600 text-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
                          </svg></a>';

                        } else {

                            echo '<h1 class="text-5xl mb-10 ">La bataille commence !</h1>';

                        }
                    }
            ?>

        </div>
    </main>
</body>
</html>