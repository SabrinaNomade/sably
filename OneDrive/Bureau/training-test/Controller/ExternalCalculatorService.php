<?php 

class ExternalCalculatorService {

    public static function performComplexCalculation (int $a, int $b, int $c): float{
        return $a + sqrt(num: $b * $c);

    }

    public function performComplexSuit (int $limit):int|string{
        $result = "0";
        for($i = 0; $i <= $limit; $i++){
            $result .= " $i";
        }
        return rtrim($result, ', '); // Retirer la dernière virgule et espace
    }
}