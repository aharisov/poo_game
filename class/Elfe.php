<?php

class Elfe extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);

        // generate random attributes numbers
        $this->force = rand(150, 250);
        $this->pv = rand(300, 350);
        $this->endurance = rand(200, 250);
        $this->race = "Elfe";
        $this->picture = "./assets/elf.png";
    }
}