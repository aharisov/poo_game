<?php

class Orc extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        // generate random attributes numbers
        $picturesOrc = ["./assets/orc.png", "./assets/orc2.png", "./assets/orc3.png"];

        $this->force = rand(250, 300);
        $this->pv = rand(350, 400);
        $this->endurance = rand(50, 100);
        $this->race = "Orc";
        $this->picture = $picturesOrc[array_rand($picturesOrc)];
    }
}