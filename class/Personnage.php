<?php

abstract class Personnage {
    protected $force;
    protected $pv; 
    protected $endurance;
    protected $nom;
    protected $race;
    protected $color;
    protected $picture;

    public function __construct($nom) {
        $this->nom = $nom;
        $this->color = $this->randomColor();
    }

    // get necessary prop
    public function __get($prop) {
        return $this->$prop;
    }

    // set value of necessary prop
    public function __set($prop, $val) {
        $this->$prop = $val;
    }

    // generate color for personage
    public function randomColor() {
        $colors = ["blue", "brown", "violet", "orange", "gold", "lightblue", "lightgreen", "pink"];

        return $colors[array_rand($colors)];
    }

    public static function generatePersonnage() {
        $races = ["Orc", "Humain", "Elfe"];
        $nomsOrc = ["Azog", "Bolg", "Golfimbul", "Grishnákh", "Shagrat", "Gorbag", "Snaga", "Uglúk"];
        $nomsElf = ["Kementari", "Amlach", "Aerin", "Elros", "Danaé"];
        $nomsHumain = ["Georcanord", "Lenmar", "Dinotine", "Pherfortin", "Markacar", "Barbeorth"];
        $getNom = "";

        $getRace = $races[array_rand($races)];

        switch ($getRace) {
            case "Orc":
                $getNom = $nomsOrc[array_rand($nomsOrc)];
                break;
            case "Humain":
                $getNom = $nomsHumain[array_rand($nomsHumain)];
                break;
            case "Elfe":
                $getNom = $nomsElf[array_rand($nomsElf)];
                break;
            default:
                break;    
        }

        return new $getRace($getNom);
    }

    public function attaquer($cible, $isDuel) {
        // transform difference between endurance and force to 0 if it's sub 0
        // calculate new value of pv
        $newPvValue = ($this->force - $cible->endurance) < 0 ? 0 : $this->force - $cible->endurance;
        
        // reduce endurance value
        $cible->endurance -= rand(5, 10);
        
        // set new value of pv
        $cible->pv = $cible->pv - $newPvValue;
        $html = "";

        // only alive personage can attack
        if ($this->pv > 0) {
            
            // show message that one personage attacked another
            $html .= "<h3 style='color: $this->color'>Un personnage $this->race $this->nom attaque $cible->race $cible->nom avec le force $this->force.</h3>";
            
            if ($cible->__get("pv") > 0) {
                // show number of left pv if victim is alive
                $html .= "<h4>Il reste $cible->pv points de vie et $cible->endurance points d'endurance au $cible->race $cible->nom.</h4>";
            } else {
                // show message that victim is dead for duel
                if ($isDuel) {
                    $html .= "<h3 style='color: red;'>$cible->race $cible->nom est mort. Fin du duel.</h3>";
                } else {
                    $html .= "<h3 style='color: red;'>$cible->race $cible->nom est mort.</h3>";
                }
            }
            
        } 

        // return html code
        return $html;
    }
}