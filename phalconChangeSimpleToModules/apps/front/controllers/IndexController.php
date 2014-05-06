<?php
namespace Multiple\Front\Controllers;

class IndexController extends ControllerBase
{
	
	public function indexAction(){

		$this->view->css = array();
		$this->view->meta = array();
		$this->view->js = array();

		echo "Front / IndexController / index<br>";
		$test = new \Multiple\Front\Models\Test();
		$test2 = new \Multiple\Api\Models\Test();
		echo "{$test->test()}<br>";
		echo "{$test->test2()}<br>";
		echo $test2->test2();
	}

	public function testAction(){
		echo "Front / IndexController / test";
	}

}
