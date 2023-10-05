<?php

class Elfe extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);

        // generate random attributes numbers
        $picturesElf = ["./assets/elf.png", "./assets/elf2.png", "./assets/elf3.png"];
        
        $this->force = rand(150, 250);
        $this->pv = rand(300, 350);
        $this->endurance = rand(200, 250);
        $this->race = "Elfe";
        $this->picture = $picturesElf[array_rand($picturesElf)];
    }
}