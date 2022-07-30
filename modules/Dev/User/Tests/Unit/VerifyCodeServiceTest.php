<?php

namespace Dev\User\Tests\Unit;

use Carbon\Carbon;
use Dev\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase {


	public function test_generate_code_service()
	{
		$code = VerifyCodeService::generateCode();
		$this->assertIsNumeric($code,'Generate code is not numeric');
		$this->assertLessThanOrEqual(99999,$code,"Generate code is less than 99999");
		$this->assertGreaterThanOrEqual(10000,$code,"Generate code is greater than 10000");
	}

	public function test_verify_code_can_store()
	{
		$code = VerifyCodeService::generateCode();
		VerifyCodeService::store(1,$code,Carbon::now()->addSeconds(1));
		$this->assertEquals($code,cache()->get('verify-code-1'));
	}
}
