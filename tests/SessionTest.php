<?php

class SessionTest extends PHPUnit_Framework_TestCase
{

    public function testIsThereAnySyntaxError()
    {
        $var = new Snelling\Session(new Snelling\Redis());
        $this->assertTrue(is_object($var));
        unset($var);
    }
}