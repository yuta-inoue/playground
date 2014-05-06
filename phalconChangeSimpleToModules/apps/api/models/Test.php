<?php
namespace Multiple\Api\Models;

class Test extends \Phalcon\Mvc\Model
{

	public function test(){
		return 'Multiple\Api\Models :: Test -&gt; test()';
	}
	
	public function test2(){
		return 'Multiple\Api\Models :: Test -&gt; test2()';
	}

}
