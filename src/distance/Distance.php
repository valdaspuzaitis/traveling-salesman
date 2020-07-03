<?php

namespace Src\distance;

class Distance {
    public static function calculateDistance(array $a, array $b): float
    {
        $aX = $a[0];
        $aY = $a[1];
        $bX = $b[0];
        $bY = $b[1];
        $lengthX;
        $lengthY;

        if($aX > $bX){
            $lengthX = $aX - $bX;
        } else {
            $lengthX = $bX - $aX;
        }

        if($aY > $bY){
            $lengthY = $aY - $bY;
        } else {
            $lengthY = $bY - $aY;
        }

        return sqrt(pow($lengthX, 2) + pow($lengthY, 2));
    }
}
