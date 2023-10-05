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

        //------------- duel start ---------------------------
        
        // array for stocking duelist
        /*
        $domeDuTonnere = [
            new Orc("Loïc"), 
            new Humain("Yanick")
        ];

        echo "<h2>Le duel commence</h2>";
        */

        // make attacks while all duelists are alive
        /*
        while ($domeDuTonnere[0]->__get("pv") > 0 && $domeDuTonnere[1]->__get("pv") > 0) {
            
            // change attacker every time
            foreach($domeDuTonnere as $index => $perso) {
                
                $cible = $index == 0 ? 1 : 0;
                
                sleep(1);
                echo $perso->attaquer($domeDuTonnere[$cible], true);
                ob_flush();
                flush();
            }

        }*/
        //-------------- duel end ----------------------------

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
        <div class="flex items-center flex-col h-1/2 w-1/2 mx-auto my-10 p-10 border-double border-4 rounded-lg border-indigo-600 overflow-y-scroll">
            
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
                            
                            Duel::startDuel($domeDuTonnere);

                        } else {

                            echo '<h1 class="text-5xl mb-10 ">La bataille commence !</h1>';

                        }
                    }
            ?>

            <div class="player">
                <?php $test = Personnage::generatePersonnage(); 
                    var_dump($test);
                
                    echo '<div class="name">' . $test->race . ' ' . $test->nom. '</div>';
                    echo '<div class="pic"><img src="' . $test->picture . '" alt="">';
                    echo '<div class="props">';
                    echo '<p>Force - ' . $test->force . '</p>';
                    echo '<p>PV - ' . $test->pv . '</p>';
                    echo '<p>Endurance - ' . $test->endurance . '</p>';
                ?>

                
            </div>
        </div>
    </main>
</body>
</html>