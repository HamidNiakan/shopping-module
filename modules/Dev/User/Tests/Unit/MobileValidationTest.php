<?php

namespace Dev\User\Tests\Unit;

use Dev\User\Rules\ValidMobile;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mobile_can_not_be_less_than_10_character()
    {
       $result = (new ValidMobile())->passes('','91782230');
	   
	   $this->assertEquals($result, 0);
    }
	
	public function test_mobile_can_not_be_more_than_10_character()
	{
		$result = (new ValidMobile())->passes('','91782230378');
		$this->assertEquals($result,0);
	}
	
	public function test_mobile_must_be_start_by_9()
	{
		$result = (new ValidMobile())->passes('','1782230378');
		$this->assertEquals($result,0);
	}
	public function test_mobile_valid()
	{
		$result = (new ValidMobile())->passes('','9178223037');
		$this->assertEquals($result,1);
	}
}
