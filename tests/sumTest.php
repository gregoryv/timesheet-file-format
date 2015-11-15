<?php

class Bin_sumTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @group unit
     */
    public function test()
    {
        $root = __DIR__ . "/../";
        $file = $root . 'data/example.ets';
        $cmd = sprintf('php %s/bin/sum.php %s', $root, $file);
        $result = array();
        exec($cmd, $result);
        $this->assertContains('sum', $result[0]);
    }
}
