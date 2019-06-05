<?php
$crystals = trim(readline());
$crystals = explode(", ", $crystals);
$desiredThickness = array_shift($crystals);
if ($desiredThickness > 0) {
    $cut = function ($crystalThickness) {
        $crystalThickness /= 4;
        return $crystalThickness;
    };
    $lap = function ($crystalThickness) {
        $crystalThickness -= 0.2 * $crystalThickness;
        return $crystalThickness;
    };
    $grind = function ($crystalThickness) {
        $crystalThickness -= 20;
        return $crystalThickness;
    };
    $etch = function ($crystalThickness) {
        $crystalThickness -= 2;
        return $crystalThickness;
    };
    $xRay = function ($crystalThickness) {
        $crystalThickness += 1;
        return $crystalThickness;
    };
    $wash = function ($crystalThickness) {
        $crystalThickness = floor($crystalThickness);
        return $crystalThickness;
    };
    foreach ($crystals as $crystal) {
        $result = "Processing chunk $crystal microns\n";
        $operations = ['Cut' => $cut, 'Lap' => $lap, 'Grind' => $grind];
        foreach ($operations as $operationName => $operation) {
            $newCrystal = $crystal;
            $count = -1;
            while ($newCrystal >= $desiredThickness) {
                $crystal = $newCrystal;
                $count += 1;
                $newCrystal = $operation($newCrystal);
            }
            if ($count > 0) {
                $result .= "$operationName x{$count}\n";
                $result .= "Transporting and washing\n";
                $crystal = $wash($crystal);
            }
            if ($crystal == $desiredThickness) {
                break;
            }
        }
        if ($crystal == $desiredThickness) {
            $result .= "Finished crystal $crystal microns\n";
        } else {
            $newCrystal = $crystal;
            $count = 0;
            while ($newCrystal > $desiredThickness) {
                $count += 1;
                $newCrystal = $etch($newCrystal);
            }
            if ($count > 0) {
                $result .= "Etch x{$count}\n";
                $result .= "Transporting and washing\n";
                $newCrystal = $wash($newCrystal);
            }
            if ($newCrystal == $desiredThickness) {
                $result .= "Finished crystal $newCrystal microns\n";
            } else {
                $count = 0;
                while ($newCrystal < $desiredThickness) {
                    $count += 1;
                    $newCrystal = $xRay($newCrystal);
                }
                $result .= "X-ray x{$count}\n";
                $result .= "Finished crystal $newCrystal microns\n";
            }
        }
        echo $result;
    }
}
