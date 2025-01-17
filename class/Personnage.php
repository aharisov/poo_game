<?php

abstract class Personnage {
    protected $force;
    protected $pv; 
    protected $endurance;
    protected $nom;
    protected $race;
    protected $color;

    public function __construct($nom) {
        $this->nom = $nom;
        $this->color = 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255). ')';
    }

    // get necessary prop
    public function __get($prop) {
        return $this->$prop;
    }

    // set value of necessary prop
    public function __set($prop, $val) {
        $this->$prop = $val;
    }

    public function attaquer($cible, $isDuel) {
        //var_dump($this);
        //var_dump($cible);

        // transform difference between endurance and force to 0 if it's sub 0
        // calculate new value of pv
        $newPvValue = ($this->force - $cible->endurance) < 0 ? 0 : $this->force - $cible->endurance;
        
        // set new value of pv
        $cible->pv = $cible->pv - $newPvValue;
        $html = "";

        // only alive personage can attack
        if ($this->pv > 0) {
            
            // show message that one personage attacked another
            $html .= "<h3 style='color: $this->color'>Un personnage $this->race $this->nom attaque $cible->race $cible->nom avec le force $this->force.</h3>";
            
            if ($cible->pv > 0) {
                // show number of left pv if victim is alive
                $html .= "<h4>Il reste " . $cible->pv . " points au $cible->race $cible->nom.</h4>";
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