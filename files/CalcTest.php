<?php

class CalcTest
{
    /**
     * @var \Test\CalcItem $calcItem
     */
    private $calcItem;

    /**
     * @var \Test\Calc $calc
     */
    private $calc;

    public function setUp()
    {
        $this->calcItem = $this->getMockBuilder('Test\CalcItem')
            ->setMethods(['add'])
            ->getMock();

        $this->calcItem->expects($this->any())
            ->method('add')
            ->will($this->returnValue(4));
        $this->calc = new Calc($this->calcItem);
    }

    public function tearDown()
    {
        unset($this->calc);
    }

    /**
     * @dataProvider provideSum
     */
    public function testSum($items, $expected)
    {
        $output =  $this->calc->sum($items[0],$items[1]);
        $this->assertEquals($expected, $output, "Sum should be {$expected}");
    }

    public function provideSum()
    {
        return [
           'result value 4' => [[2,2],4],
            [[2,1],3],
            [[2,-2],0]
        ];
    }

    public function testTax()
    {
        $input = 10.00;
        $taxInput = 0.10;
        $output = $this->calc->tax($input, $taxInput);
        $this->assertEquals(1.00, $output, 'Błąd asserta');
    }

    public function testManyFun()
    {
        $calc = $this->getMockBuilder('Test\Calc')
            ->setConstructorArgs([$this->calcItem])
            ->setMethods(['sum', 'tax'])
            ->getMock();
        $calc->expects($this->once())->method('sum')->with(2,2)->will($this->returnValue(4));
        $calc->method('tax')->will($this->returnValue(1));
        $result = $calc->many();
        $this->assertEquals(5, $result, 'fail');
    }

    public function testExpect()
    {
        $this->expectException('BadMethodCallException');
        $this->calc->expect(-1);
    }

    public function testRandom()
    {
        $this->assertEquals(6, $this->calc->random(2));
    }
}


// assertEqual ==
// assertSame ===