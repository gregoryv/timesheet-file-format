<?php
use gregoryv\timesheet\Sheet;
use gregoryv\timesheet\TimeTag;

class SheetTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $txt = $this->sheet = file_get_contents(__DIR__ . '/../example.timesheet');
        $this->sheet = new Sheet($txt);
    }


    /**
     * @test
     * @group unit
     */
    public function test_readTimeTags()
    {
        $expected = array(
            7,-1,
            9,1,
            new TimeTag(0,30), new TimeTag(0,30),

            new TimeTag(8,30), 
            new TimeTag(7,30),            
            8,8,
            8,new TimeTag(4,30),

            8,8,8,8,8,
            8,new TimeTag(8), 8,new TimeTag(8),8,8,8,

            8,8,8,8, new TimeTag(7, 15), new TimeTag(0, -45)
        );
        for ($i=0; $i < sizeof($expected); $i++) { 
            $e = $expected[$i];
            $expected[$i] = is_int($e) ? new TimeTag($e) : $e;
        }

        $result = $this->sheet->readTimeTags();
        for ($i=0; $i < sizeof($result); $i++) { 
            $this->assertEquals($expected[$i]->hours, $result[$i]->hours);
            $this->assertEquals($expected[$i]->minutes, $result[$i]->minutes);            
        }
    }
}

