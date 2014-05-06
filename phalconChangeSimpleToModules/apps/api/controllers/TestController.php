<?php
namespace Multiple\Api\Controllers;

class TestController extends ControllerBase
{
	public function indexAction()
	{
		echo "API / TestController / Index";
	}
	public function testAction()
	{
		echo "API / TestController / Test";
	}
}

