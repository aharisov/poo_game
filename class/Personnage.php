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

    // generate new player
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

    public static function showPersonnage($jouyeur) {
        $html = "<div class='player'>";
        $html .= "<div class='name'>$jouyeur->race $jouyeur->nom</div>";
        $html .= "<div class='pic'><img src='$jouyeur->picture' alt=''/></div>";
        $html .= "<div class='props'>";
        $html .= "<p>Force - $jouyeur->force</p>";
        $html .= "<p>PV - $jouyeur->pv</p>";
        $html .= "<p>Endurance - $jouyeur->endurance</p>";
        $html .= "</div></div>";

        return $html;
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
            $html .= "<p style='color: $this->color'><b>$this->race $this->nom</b> attaque <b>$cible->race $cible->nom</b>.</p>";
            
            if ($cible->__get("pv") > 0) {
                // show number of left pv if victim is alive
                $html .= "<p><b>$cible->race $cible->nom</b>: <b><i>-$cible->pv</i></b> de pv et <b><i>-$cible->endurance</i></b> d'endurance.</h4>";
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