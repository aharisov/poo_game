<?php

class Humain extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        // generate random attributes numbers
        $picturesHumain = ["./assets/humain.png", "./assets/humain2.png", "./assets/humain3.png"];

        $this->force = rand(100, 150);
        $this->pv = rand(200, 250);
        $this->endurance = rand(150, 200);
        $this->race = "Humain";
        $this->picture = $picturesHumain[array_rand($picturesHumain)];
    }
}