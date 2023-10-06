<?php

class Duel {
    public static function startDuel($jouyeurs) {

        while ($jouyeurs[0]->pv > 0 && $jouyeurs[1]->pv > 0) {
            
            // change attacker every time
            foreach($jouyeurs as $index => $jouyeur) {
                // change player's index
                $jouyeurIndex = $index == 0 ? 1 : 0;
                
                sleep(1);
                // invoke attack
                echo $jouyeur->attaquer($jouyeurs[$jouyeurIndex], true);

                // calculate number for width style of pv element
                $newWidthForce = $jouyeur->force * 100;

                if ($jouyeurs[$jouyeurIndex]->pv > 0) {
                    $newWidthPv = $jouyeurs[$jouyeurIndex]->pv * 100;
                } else {
                    $newWidthPv = 0;
                }

                // calculate number for width style of endurance element
                if ($jouyeurs[$jouyeurIndex]->endurance > 0) {
                    $newWidthEndurance = $jouyeurs[$jouyeurIndex]->endurance * 100;
                } else {
                    $newWidthEndurance = 0;
                }
                
                // add to html and change width of boxes to show that numbers are decreasing
                $pvNum = $jouyeurs[$jouyeurIndex]->pv < 0 ? 0 : $jouyeurs[$jouyeurIndex]->pv;
                echo "
                <script>
                    pv".spl_object_id($jouyeurs[$jouyeurIndex]).".style.width = $newWidthPv / parent".spl_object_id($jouyeurs[$jouyeurIndex]).".getAttribute('data-pv') + '%';
                    endurance".spl_object_id($jouyeurs[$jouyeurIndex]).".style.width = $newWidthEndurance / parent".spl_object_id($jouyeurs[$jouyeurIndex]).".getAttribute('data-endur') + '%';
                    force".spl_object_id($jouyeur).".style.width = $newWidthForce / parent".spl_object_id($jouyeur).".getAttribute('data-f') + '%';
                    pvNum".spl_object_id($jouyeurs[$jouyeurIndex]).".innerText = " . $pvNum .";
                    enduranceNum".spl_object_id($jouyeurs[$jouyeurIndex]).".innerText = " . $jouyeurs[$jouyeurIndex]->endurance .";
                    forceNum".spl_object_id($jouyeurs[$jouyeurIndex]).".innerText = " . $jouyeurs[$jouyeurIndex]->force .";
                </script>";
                ob_flush();
                flush();
                
            }

        }

    }
}