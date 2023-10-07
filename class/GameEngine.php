<?php

class GameEngine {
    // array of players
    public $combattants = [];
    public $sameRace = [];

    // function for generating random number
    private function randNum($min, $max) {
        return rand($min, $max);
    } 

    // method for saving players in the game
    public function addCombattant($joueur) {

        // add every player to players array
        array_push($this->combattants, $joueur);
    }

    // method for starting game
    public function start() {

        while(count($this->combattants) > 1) {
            
            sleep(0.5);

            // make tour
            $this->tourDeJeu();

            // clean the battle field
            echo $this->nettoyerMort();

            // check if there are players of others races
            $count = $this->countRaces();
            
            // break cycle if there are not
            if ($count == 0) {
                break;
            }
        }

        $this->fin();
    }

    // method for getting random player's id
    public function getId() {

        // get index of random player in players array and show it
        return array_rand($this->combattants);
    }

    // method for getting random player
    public function getJoueur() {
        
        return $this->combattants[$this->getId()];
    }

    // method for getting all players
    public function getToutesJoueurs() {
        
        return $this->combattants;
    }

    // method for every game tour
    public function tourDeJeu() {
        sleep(1);
        // get random attacker
        $combattant = $this->getJoueur();
        
        // only alive player can attack
        if ($combattant->pv > 0) {

            // count number for calculating percentage for html element force
            $newWidthForce = $combattant->force * 100;

            // get random victim
            $cible = $this->getJoueur();

            // the victim should not be the same player 
            // and should be of the other race
            if ($cible != $combattant && $combattant->race != $cible->race && $cible->pv > 0) { 
                echo $combattant->attaquer($cible, false);

                // count number for calculating percentage for html element pv
                if ($cible->pv > 0) {
                    $newWidthPv = $cible->pv * 100;
                } else {
                    $newWidthPv = 0;
                }

                // count number for calculating percentage for html element endurance
                if ($cible->endurance > 0) {
                    $newWidthEndurance = $cible->endurance * 100;
                } else {
                    $newWidthEndurance = 0;
                }

                // pv should not be sub zero
                $pvNum = $cible->pv < 0 ? 0 : $cible->pv;

                // change elements width and numbers in it dynamically
                echo "
                    <script>
                        pv".spl_object_id($cible).".style.width = $newWidthPv / parent".spl_object_id($cible).".getAttribute('data-pv') + '%';
                        endurance".spl_object_id($cible).".style.width = $newWidthEndurance / parent".spl_object_id($cible).".getAttribute('data-endur') + '%';
                        force".spl_object_id($combattant).".style.width = $newWidthForce / parent".spl_object_id($combattant).".getAttribute('data-f') + '%';

                        pvNum".spl_object_id($cible).".innerText = " . $pvNum . ";
                        enduranceNum".spl_object_id($cible).".innerText = " . $cible->endurance . ";
                        forceNum".spl_object_id($combattant).".innerText = " . $combattant->force . ";
                    </script>
                ";
            } 
            ob_flush();
            flush();
        }
    }

    // count number of players of each race
    // for finishing game if there left only the players of the same race
    private function countRaces() {
        $races = ['Orc' => 0, 'Elfe' => 0, 'Humain' => 0];

        foreach($this->combattants as $joueur) {    
            $races[$joueur->race]++;
        }

        if (
            ($races['Orc'] == 0 && $races['Elfe'] == 0)
            || ($races['Elfe'] == 0 && $races['Humain'] == 0)
            || ($races['Orc'] == 0 && $races['Humain'] == 0)
        ) {
            return 0;
        } else {
            return 1;
        }
    }

    // method for deleting dead players from the game
    private function nettoyerMort() {

        // search for dead players in players array
        foreach($this->combattants as $combattant) {

            // if players does not have pv
            if ($combattant->pv <= 0) {

                // find index of player in array and remive player from array
                $key = array_search($combattant, $this->combattants);
                unset($this->combattants[$key]);

                // show who was killed
                return '<h3 style="color: red;">' . $combattant->race . ' ' . $combattant->nom . ' quitte le champ de bataille</h3>';
            }
        }
    }

    // show in html buttons return home and refresh game
    public static function returnRefreshButtons($url) {
        echo '<a href="'. $url .'" class="refresh-btn border-2 rounded-lg absolute p-5 border-purple-600 bg-purple-600 hover:bg-purple-800 text-lg uppercase text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
        </svg></a>';

        echo '<a href="http://localhost/poo_thegame/" class="return-home border-2 rounded-lg p-5 border-rose-600 hover:bg-rose-800 bg-rose-600 text-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
        </svg></a>';
    }

    // method for finishing the game
    private function fin() {

        // show one winner
        // or all winners of the sam race
        foreach($this->combattants as $dernierJoueur) {
            // show the winner
            echo '<h3 style="color: green;">' . $dernierJoueur->race . ' ' . $dernierJoueur->nom . ' est gagné. Félicitations.</h3>';
            echo "<script>parent".spl_object_id($dernierJoueur).".classList.add('winner')</script>";
        }
    }
}