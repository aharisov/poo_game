<?php

abstract class Personnage {
    protected $force;
    protected $pv; 
    protected $endurance;
    protected $nom;
    protected $race;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    // get necessary prop
    public function __get($prop) {
        return $this->$prop;
    }

    // set value of necessary prop
    public function __set($prop, $val) {
        $this->$prop = $val;
    }

    public function attaquer($cible) {
        //var_dump($this);
        //var_dump($cible);

        // transform difference between endurance and force to 0 if it's sub 0
        $defenceValue = ($this->force - $cible->__get("endurance")) < 0 ? 0 : $this->force - $cible->__get("endurance");
        // get new value of pv
        $newPv = $cible->__get("pv") - $defenceValue;
        // set new value of pv
        $cible->__set("pv", $newPv);
        $html = "";

        // only alive personage can attack
        if ($this->pv > 0) {
            
            // show message that one personage attacked another
            $html .= "<h3>Un personnage $this->race $this->nom attaque $cible->race $cible->nom avec le force $this->force.</h3>";
            
            if ($cible->__get("pv") > 0) {
                // show number of left pv if victim is alive
                $html .= "<h4>Il reste " . $cible->__get("pv") . " points au $cible->race $cible->nom.</h4>";
            } else {
                // show message that victim is dead
                $html .= "<h3 style='color: red;'>$cible->race $cible->nom est mort. Fin du duel.</h3>";
            }
            
        } 

        // return html code
        return $html;
    }
}