<?php
namespace Bronk\Test;

require_once "kleuterclass.php";

use PHPUnit\Framework\TestCase;

class KleuterClassTest extends TestCase
{
    public function testIsCalculationGood()
    {
        $kleuterClass = new KleuterClass();
        $a = (int) 13;
        $b = (int) 666;
        $expected = ($a ** ($b / 2)) + 3;
        $result = $kleuterClass->weirdCalculation($a, $b);

        $this->assertEquals($expected, $result);
    }
}

