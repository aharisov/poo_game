<?php

class Duel {
    public static function startDuel($jouyeurs) {
        while ($jouyeurs[0]->__get("pv") > 0 && $jouyeurs[1]->__get("pv") > 0) {
            
            // change attacker every time
            foreach($jouyeurs as $index => $jouyeur) {
                
                $cible = $index == 0 ? 1 : 0;
                
                sleep(1);
                echo $jouyeur->attaquer($jouyeurs[$cible], true);
                ob_flush();
                flush();
            }

        }
    }
}