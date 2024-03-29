<?php
class MkRandomCode {

	private $randomData = array(
		'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
		'str' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'strL' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'strS' => 'abcdefghijklmnopqrstuvwxyz',
		'num' => '0123456789'
	);
	private $randomType = 'all';
	private $result = '';

	public function __construct($randomType = null){
		$this->set($randomType);
	}

	public function get($len , $len2){

		$len = (!empty($len) && $len > 0) ? intval($len) : 6;
		$len = (!empty($len2) && $len < $len2) ? mt_rand($len , $len2) : $len;
		$data = $this->randomData[$this->randomType];
		$arr = preg_split("//" , $data);
		$arr = array_filter($arr , 'strlen');
		$arr = array_values($arr);
		$strCnt = count($arr) - 1;
		for($i = 0; $i < $len; $i++){
			$this->result = "{$this->result}{$arr[mt_rand(0,$strCnt)]}";
		}
		return $this->result;
	}
	public function set($randomType){
		$this->randomType = (!empty($this->randomData[$randomType])) ? $randomType : 'all';
	}
	public function getRandomTypeList(){
		return $this->randomData;
	}
	public function getResult(){
		return $this->result;
	}
}