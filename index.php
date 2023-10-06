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
    ?>

    <main class="flex justify-center items-center ">
        <div class="game-container <?php if ($_GET && $_GET["game"] == "battle") echo 'game-container-big';?> <?php if (!$_GET) echo 'justify-center';?> border-double border-4 rounded-lg border-indigo-600">
            
            <?php if (!$_GET) {?>
                
                <h1 class="text-5xl mb-10 ">Faites votre choix !</h1>

                <div class="flex justify-center max-w-5xl">
                    <a href="?game=duel" class="border-2 rounded-lg mr-5 p-5 border-purple-600 bg-purple-600 hover:bg-purple-800 text-lg uppercase text-white">commencer un duel</a>
                    <a href="?game=battle" class="border-2 rounded-lg p-5 border-rose-600 hover:bg-rose-800 bg-rose-600 text-lg uppercase text-white">commencer une bataille</a>
                </div>
                
            <?php } else {
             
                        if ($_GET && $_GET["game"] == "duel") {
                            
                            // generate players for duel
                            $domeDuTonnere = [
                                Personnage::generatePersonnage(), 
                                Personnage::generatePersonnage()
                            ];

                            echo "<h1 class='text-5xl mb-10'>Le duel commence !</h1>";
                            echo "<div class='battle-field'>";
                            
                            // show players on the filed
                            echo Personnage::showPersonnage($domeDuTonnere[0]);
                            echo Personnage::showPersonnage($domeDuTonnere[1]);

                            echo "
                            <script>
                                let parent".spl_object_id($domeDuTonnere[0])." = document.getElementById('player-".spl_object_id($domeDuTonnere[0])."');
                                let pv".spl_object_id($domeDuTonnere[0])." = document.querySelector('#' + parent".spl_object_id($domeDuTonnere[0]).".getAttribute(`id`) + ' .pv span');
                                let endurance".spl_object_id($domeDuTonnere[0])." = document.querySelector('#' + parent".spl_object_id($domeDuTonnere[0]).".getAttribute(`id`) + ' .endurance span');
                                let force".spl_object_id($domeDuTonnere[0])." = document.querySelector('#' + parent".spl_object_id($domeDuTonnere[0]).".getAttribute(`id`) + ' .force span');
                                let parent".spl_object_id($domeDuTonnere[1])." = document.getElementById('player-".spl_object_id($domeDuTonnere[1])."');
                                let pv".spl_object_id($domeDuTonnere[1])." = document.querySelector('#' + parent".spl_object_id($domeDuTonnere[1]).".getAttribute(`id`) + ' .pv span');
                                let endurance".spl_object_id($domeDuTonnere[1])." = document.querySelector('#' + parent".spl_object_id($domeDuTonnere[1]).".getAttribute(`id`) + ' .endurance span');
                                let force".spl_object_id($domeDuTonnere[1])." = document.querySelector('#' + parent".spl_object_id($domeDuTonnere[1]).".getAttribute(`id`) + ' .force span');
                            </script>
                            ";
                            
                            echo "<div class='field-inner'>";
                            // start duel
                            Duel::startDuel($domeDuTonnere);
                            echo "</div></div>";

                            GameEngine::returnRefreshButtons("?game=duel");

                        } else {

                            echo '<h1 class="text-5xl mb-10 ">La bataille commence !</h1>';

                            $game = new GameEngine();

                            // generate all players, min 3 and max 10
                            for ($i = 1; $i <= rand(3, 10); $i++) {
                                $game->addCombattant(Personnage::generatePersonnage()); 
                            }

                            echo "<div class='battle-field-big battle-count-".count($game->getToutesJoueurs())."'>";
                            // show all players on the field
                            foreach($game->getToutesJoueurs() as $jouyeur) {
                                echo Personnage::showPersonnage($jouyeur);

                                echo "
                                    <script>
                                        let parent".spl_object_id($jouyeur)." = document.getElementById('player-".spl_object_id($jouyeur)."');
                                        let pv".spl_object_id($jouyeur)." = document.querySelector('#' + parent".spl_object_id($jouyeur).".getAttribute(`id`) + ' .pv span');
                                        let endurance".spl_object_id($jouyeur)." = document.querySelector('#' + parent".spl_object_id($jouyeur).".getAttribute(`id`) + ' .endurance span');
                                        let force".spl_object_id($jouyeur)." = document.querySelector('#' + parent".spl_object_id($jouyeur).".getAttribute(`id`) + ' .force span');
                                    </script>
                                ";
                            }
                            
                            echo "<div class='field-inner'>";
                            $game->start();
                            echo "</div>";

                            GameEngine::returnRefreshButtons("?game=battle");
                            echo "</div>";
                        }
                    }
            ?>

        </div>
    </main>

</body>
</html>