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

    protected function attaquer($cible) {
        return "<h3>Un personnage $this->race $this->nom attaque $cible.</h3>";
    }
}