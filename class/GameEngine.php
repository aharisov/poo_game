<?php

class GameEngine {
    // array of players
    public $combattants = [];

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
            $this->tourDeJeu();
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
        // get random player and return this object
        return $this->combattants[$this->getId()];
    }

    // method for every game tour
    public function tourDeJeu() {
        
        // every player attacks during one tour
        foreach($this->combattants as $combattant) {

            // only alive player can attack
            if ($combattant->pv > 0) {
                // get random victim
                $cible = $this->getJoueur();

                // the victim should not be the same player
                if ($cible != $combattant) {
                    echo $combattant->attaquer($cible, false);
                }
            } else {
                // clean the battle field
                echo $this->nettoyerMort();
            }
        }
    }

    // method for deleting dead players from the game
    public function nettoyerMort() {

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

    // method for finishing the game
    public function fin() {
        // get the last player
        $dernierJoueur = current($this->combattants);

        // show the winner
        echo '<h3 style="color: green;">' . $dernierJoueur->race . ' ' . $dernierJoueur->nom . ' est gagné. Félicitations.</h3>';
    }
}