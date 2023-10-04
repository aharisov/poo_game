<?php

class Humain extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        $this->force = 105;
        $this->pv = 130;
        $this->endurance = 45;
        $this->race = "Humain";
    }
}