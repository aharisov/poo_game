<?php

class Orc extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        $this->force = 115;
        $this->pv = 150;
        $this->endurance = 100;
        $this->race = "Orc";
    }
}