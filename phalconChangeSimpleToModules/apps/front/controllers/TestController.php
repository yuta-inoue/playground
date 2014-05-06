<?php
namespace Multiple\Front\Controllers;

class TestController extends ControllerBase
{

	public function indexAction(){

		$this->view->css = array();
		$this->view->meta = array();
		$this->view->js = array();

		echo "API / TestController / Index";
	}

	public function testAction(){

		$this->view->css = array();
		$this->view->meta = array();
		$this->view->js = array();
		
		echo "API / TestController / Test";
	}

}
