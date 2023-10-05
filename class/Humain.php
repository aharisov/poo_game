<?php

class Humain extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        // generate random attributes numbers
        $this->force = rand(100, 150);
        $this->pv = rand(200, 250);
        $this->endurance = rand(150, 200);
        $this->race = "Humain";
        $this->picture = "./assets/humain.png";
    }
}