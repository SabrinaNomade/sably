<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
require __DIR__ . '/../controller/Calculator.php';


class CalculatorTest extends TestCase {

    private $calculator;


    protected function setUp():void{

        $this->calculator = new Calculator();


    }
   
    

     public function testSubtractReturnsCorrectDifference()
 {
 $result = $this->calculator->subtract(10, 5);
 $this->assertEquals(5, $result);
 }

 /**
  * @group simpleTests
  * 
  */
 public function testAdd(){
    $this->setUp();
    $result = $this->calculator::add(1, 2);
    $this->assertEquals(3, $result);
    $this->tearDown();
  }
    
  /**
   * @group simpleTests
   */
   

    public function testMultiply():void{
        $this->setUp();
        $result = $this->calculator::multiply(a:4, b:3);
        $this->assertEquals(12, $result);
        $this->tearDown();
      }



 /**
   * @dataProvider additionProvider
   *    @group additionGroup
   */
  public function testAddGroup(int $a, int $b, int $expected){
    $this->setUp();
    $result = $this->calculator::add($a, $b);
    $this->assertEquals($expected, $result);
    $this->tearDown();
  }

public static function additionProvider():array {

    return[
        [1,2,3],
        [0,0,0],
        [-1,1,0],
        //[12,85,6],
        [3,3,6],[ ]
    ];
}

public function testDivideByZeroThrowsException(){
    $this->setUp();
    /**
     * On teste une division par zéro
     */
$this->expectException(DivisionByZeroError::class);
$this->expectExceptionMessage("division par zéro impossible!");
$this->calculator->divide(a: 12, b: 0);
    $this->tearDown();
  }


  public function testthrowManualException(): void{
    $this->setUp();
    $this->expectExceptionMessage("cette methode retourne une exception!");
    $this->calculator::throwExceptionCalculator();
    $this->tearDown();

  }
  /**
   * @dataProvider divisionProvider
   */
  public function testDivideGroup(int $a, int $b, int $expected)
  {
    $this->setUp();
    if($b === 0){
      $this->expectException(DivisionByZeroError::class);
      $this->expectExceptionMessage("Division by zero");
    }
    $result = $this->calculator::divide($a, $b);
    $this->assertEquals($expected, $result);
    $this->tearDown();
  }

  public static function divisionProvider()
  {
    return [
      [12, 4, 3],
      [44, 2, 22],
      [6, 0, 0]
    ];
  }
  public function testCalculatedComplexOperation()
  {
      $externalServiceMock = $this->createMock(ExternalCalculatorService::class);

      $externalServiceMock
          ->expects($this->once())
          ->method('performComplexCalculation')
          ->with(1, 9, 9)  // Appel avec des arguments spécifiques
          ->willReturn(10);

      $calculator = new Calculator(externalService:$externalServiceMock);
      $result = $calculator->calculateAdvancedOperation(a:1,b: 9,c: 9);
      $this->assertEquals(10, $result);
      unset($calculator);
  }
  public function testFetchDataFromAPI():void{



    $mockAPIService = $this->createMock(APIService::class);

    $mockAPIService
    ->method("fetch")
    ->with("posts")
    ->willReturn(["data" => "value"]);

    $calculator = new Calculator( $mockAPIService);
     $result = $calculator->fetchDataFromAPI('endpoint');
    
     $this->assertEquals(['data' => 'value'], $result);
    }
     
    



protected function tearDown(): void {
    unset ($this->calculator);
}

    
}
