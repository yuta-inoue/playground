<?php

namespace Multiple\Front\Models;

class Test extends \Phalcon\Mvc\Model
{
	private function apiTest(){
		$result = new \Multiple\Api\Models\Test();
		return $result;
	}

	public function test(){
		return 'Multiple\Front\Models :: Test -&gt; test()';
	}
	
	public function test2(){
		$apiTest = $this->apiTest();
		return "Multiple\Front\Models :: Test -&gt; test2() , {$apiTest->test()}";
	}

}
