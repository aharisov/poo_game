<?php

class Elfe extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom);
        
        $this->force = 100;
        $this->pv = 100;
        $this->endurance = 100;
        $this->nom = "Elfe";
    }
}