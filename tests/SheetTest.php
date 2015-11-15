<?php
use gregoryv\timesheet\Sheet;
use gregoryv\timesheet\Time;

class SheetTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $txt = $this->sheet = file_get_contents(__DIR__ . '/../data/201510.ets');
        $this->sheet = new Sheet($txt);
    }


    /**
     * @test
     * @group unit
     */
    public function test_readTimes()
    {
        $expected = array(8,8,8,8,8,8,8,8,9,3,new Time(8,30),new Time(1,30),8,8,8,8);
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

