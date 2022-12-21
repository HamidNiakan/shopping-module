<?php

namespace Dev\User\Tests\Unit;

use Dev\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_password_shoud_not_be_less_than_8_character()
    {
		$result = (new ValidPassword())->passes('','H@mio');
		$this->assertEquals($result,0);
    }
	
	public function test_password_shoud_not_be_more_than_8_character()
	{
		$result = (new ValidPassword())->passes('','H@23456789');
		$this->assertEquals($result,0);
	}
	public function test_password_should_be_sign_character()
	{
		$result = (new ValidPassword())->passes('','Hamid2008');
		$this->assertEquals($result,0);
	}
	public function test_password_should_be_Upper_character()
	{
		$result = (new ValidPassword())->passes('','h@mid2008');
		$this->assertEquals($result,0);
	}
	public function test_password_should_be_lower_character()
	{
		$result = (new ValidPassword())->passes('','H@MID2008');
		$this->assertEquals($result,0);
	}
	public function test_password_should_be_digit_character()
	{
		$result = (new ValidPassword())->passes('','H@midgfs');
		$this->assertEquals($result,0);
	}
	public function test_password_valid()
	{
		$result = (new ValidPassword())->passes('','H@mid2008');
		$this->assertEquals($result,1);
	}
}
