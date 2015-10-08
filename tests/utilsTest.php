<?php
namespace gregoryv\timesheet;

class utilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @group unit
     */
    public function setDefault_ok()
    {
        $arr = array();
        setDefault($arr, 'x', 'default');
        $this->assertEquals('default', $arr['x']);
        setDefault($arr, 'x', 'nono');
        $this->assertEquals('default', $arr['x']);
    }

    /**
     * @test
     * @group unit
     */
    public function toLine_ok()
    {
        $arr = array('x' => 123, 'wham bam' => 89);
        $result = toLine($arr);
        $this->assertEquals("x=123 wham bam=89\n", $result);
      
    }
}

