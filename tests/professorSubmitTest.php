<?php

use PHPUnit\Framework\TestCase;

require_once 'src/bootstrap.php';

class professorSubmitTest extends TestCase
{

	public function isSubmit()
    {
        $myClass = new MyClass();
        
        //$str1 = 'hello';
        //$str2 = 'world';
        //$expectedResult = 'helloworld';

        //$result = $myClass->concatenateStrings($str1, $str2);

        $this->assertEquals($expectedResult, $result);
    }




}

