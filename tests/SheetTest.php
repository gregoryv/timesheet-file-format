<?php
use gregoryv\timesheet\Sheet;
use gregoryv\timesheet\Time;

class SheetTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $txt = $this->sheet = file_get_contents(__DIR__ . '/../example.ets');
        $this->sheet = new Sheet($txt);
    }


    /**
     * @test
     * @group unit
     */
    public function test_readTimes()
    {
        $expected = array(
            7,-1,
            9,1,
            new Time(0,30), new Time(0,30),

            new Time(8,30), 
            new Time(7,30),            
            8,8,
            8,new Time(4,30),

            8,8,8,8,8,
            8,new Time(8), 8,new Time(8),8,8,8,

            8,8,8,8, new Time(7, 15), new Time(0, -45)
        );
        for ($i=0; $i < sizeof($expected); $i++) { 
            $e = $expected[$i];
            $expected[$i] = is_int($e) ? new Time($e) : $e;
        }

        $result = $this->sheet->readTimes();
        for ($i=0; $i < sizeof($result); $i++) { 
            $this->assertEquals($expected[$i]->hours, $result[$i]->hours);
            $this->assertEquals($expected[$i]->minutes, $result[$i]->minutes);            
        }
    }
}

