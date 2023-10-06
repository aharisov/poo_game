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

    // show player in the page
    public static function showPersonnage($jouyeur) {
        
        $html = "<div id='player-" . spl_object_id($jouyeur) . "' class='player' data-pv='$jouyeur->pv' data-endur='$jouyeur->endurance' data-f='$jouyeur->force'>";
        $html .= "<div class='name'>$jouyeur->race $jouyeur->nom</div>";
        $html .= "<div class='pic'><img src='$jouyeur->picture' alt=''/></div>";
        $html .= "<div class='props'>";
        $html .= "<p class='force'>Force - $jouyeur->force<span></span></p>";
        $html .= "<p class='pv'>PV - $jouyeur->pv<span></span></p>";
        $html .= "<p class='endurance'>Endurance - $jouyeur->endurance<span></span></p>";
        $html .= "</div></div>";

        return $html;
    }

    public function attaquer($cible, $isDuel) {
        // calculate damage
        $dega = $this->force - $cible->endurance;
        // set damage to 0 if it's < 0
        $dega = ($dega < 0) ? 0 : $dega;

        // for showing damage in html
        if ($dega > 0) {
            $showDega = "-$dega";
        } else {
            $showDega = 0;
        }
        
        // reduce force value of attacker
        $this->force -= rand(1, 3);
        
        // reduce endurance value
        $cibleMinusEndurance = rand(5, 10);
        $cible->endurance -= $cibleMinusEndurance;
        
        // set new value of pv
        $cible->pv = $cible->pv - $dega;

        $html = "";

        // only alive personage can attack
        if ($this->pv > 0) {
            
            // show message that one personage attacked another
            $html .= "<p style='color: $this->color'><b>$this->race $this->nom</b> attaque <b>$cible->race $cible->nom</b>.</p>";
            
            if ($cible->pv > 0) {
                // show number of lost pv and endurance
                $html .= "<p><b>$cible->race $cible->nom</b>: <b style='color: darkred'><i>" . ($showDega) . "</i></b> de pv et <b style='color: darkred'><i>-$cibleMinusEndurance</i></b> d'endurance.</h4>";
            } else {
                // show message that victim is dead for duel
                if ($isDuel) {
                    $html .= "<h3 style='color: red;'>$cible->race $cible->nom est mort. Fin du duel.</h3>";
                    $html .= "<script>parent".spl_object_id($cible).".classList.add('dead')</script>";
                } else {
                    $html .= "<h3 style='color: red;'>$cible->race $cible->nom est mort.</h3>";
                    $html .= "<script>parent".spl_object_id($cible).".classList.add('dead')</script>";
                }
            }
            
        } 

        // return html code
        return $html;
    }
}