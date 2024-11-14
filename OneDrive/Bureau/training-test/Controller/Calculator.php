<?php
use PHPUnit\Framework\MockObject\MockObject;


class Calculator
{
    private $apiService;
    private $externalService;

    public function __construct(
        ExternalCalculatorService|MockObject $externalService = null,
        $apiService = null
    ) {
        if (!is_null($externalService)) {
            $this->externalService = $externalService;
        }

        if (!is_null($apiService)) {
            $this->apiService = $apiService;
        }
    }


    

   


    public function fetchDataFromAPI(string $endpoint){
      return $this->apiService->fetch($endpoint);
    }
    

    public function calculateAdvancedOperation($a, $b, $c) {
        return $this->externalService->performComplexCalculation($a, $b, $c);
    }
   
    public static function add(int $a, int $b): int
    {
        return $a + $b;
    }


    public static function multiply( int $a, int $b): int

{
    return $a * $b;
}


public static function substract( int $a, int $b): int

{
    return $a - $b;
}

public static function divide (int $a, int $b):int{
    return $a /$b ;
}

public static function throwExceptionCalculator(): never{
    throw new Exception(message: "cette methode retourne une exception!");
}


}
