<?php

class Orc extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        // generate random attributes numbers
        $this->force = rand(250, 300);
        $this->pv = rand(350, 400);
        $this->endurance = rand(50, 100);
        $this->race = "Orc";
        $this->picture = "./assets/orc.png";
    }
}