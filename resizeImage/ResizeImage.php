<?php
class ResizeImage {
	public function __construct(){
	}

	private $fileURL;
	private $width;
	private $height;
	private $newWidth;
	private $newHeight;
	private $quality;
	private $imageInfo;
	private $type;
	private $imageX = 0;
	private $imageY = 0;
	private $imageId;

	// ex) $fileURL = "/var/www/html/images/01.jpg"
	public function resize($fileURL , $width , $height , $quality , $type){

		$this->fileURL = $fileURL;
		$this->width = (!empty($width)) ? $width : 100;
		$this->height = (!empty($height)) ? $height : 100;
		$this->quality = (!empty($quality)) ? $quality : 90;
		$this->type = (!empty($type)) ? $type : 'absolute';
		$this->imageInfo = $this->getImageInfo($this->fileURL);
		$this->imageInfo = $this->exchangeWidthAndHeight($this->imageInfo);

		if($this->chkDoResize()){
			$this->setImageSize($this->type);
			$this->imageId = $this->prepareImage($this->imageInfo['type']);
			$this->imageId["origin"] = (!empty($this->imageInfo["Orientation"])) ? $this->rotate($this->imageId["origin"]) : $this->imageId["origin"];
			imagecopyresized(
				$this->imageId["copy"] , $this->imageId["origin"] ,
				0 , 0 , $this->imageX , $this->imageY ,
				$this->newWidth , $this->newHeight , $this->imageInfo["width"] , $this->imageInfo["height"]
			);
			$this->save($this->imageId["copy"]);
		}
		$this->init();
	}

	public function getImageInfo($fileURL){
		$result = array();
		$arr = (!empty($fileURL)) ? getimagesize($fileURL) : null;
		$result["width"] = (!empty($arr[0])) ? $arr[0] : null;
		$result["height"] = (!empty($arr[1])) ? $arr[1] : null;
		$result["type"] = (!empty($arr[2])) ? image_type_to_extension($arr[2] , false) : null;
		$result["mime"] = (!empty($arr["mime"])) ? $arr["mime"] : null;
		foreach($result as $val){
			if(empty($val)){
				$this->imageInfo = false;
				return false;
			}
		}
		$exif_data = @exif_read_data($fileURL);
		$result["Orientation"] = (!empty($exif_data["Orientation"])) ? $exif_data["Orientation"] : null;
		return $result;
	}

	private function init(){
		if(!empty($this->imageId)){
			imagedestroy($this->imageId["copy"]);
			imagedestroy($this->imageId["origin"]);
		}
		$this->fileURL = null;
		$this->width = null;
		$this->height = null;
		$this->newWidth = null;
		$this->newHeight = null;
		$this->quality = null;
		$this->imageInfo = null;
		$this->type = null;
		$this->imageX = 0;
		$this->imageY = 0;
		$this->imageId = null;
	}

	private function setImageSize($type){
		switch ($type) {
			case 'absolute':
				$this->setResizeAbsoluteParams();
				break;
			default:
				$this->setResizeParams();
				break;
		}
	}

	private function setResizeAbsoluteParams(){
		$rateW = $this->width / $this->imageInfo["width"];
		$rateH = $this->height / $this->imageInfo["height"];
		if($rateW <= $rateH){
			$this->imageX = ($this->imageInfo["width"] - ($this->width * ($this->imageInfo["height"] / $this->height))) / 2;
			$this->imageY = 0;
			$this->newWidth = $this->imageInfo["width"] * $rateH;
			$this->newHeight = $this->height;
		}else{
			$this->imageX = 0;
			$this->imageY = ($this->imageInfo["height"] - ($this->height * ($this->imageInfo["width"] / $this->width))) / 2;
			$this->newWidth = $this->width;
			$this->newHeight = $this->imageInfo["height"] * $rateW;
		}
	}
	private function setResizeParams(){
		$rateW = $this->width / $this->imageInfo["width"];
		$rateH = $this->height / $this->imageInfo["height"];
		if($rateW < 1 || $rateH < 1){
			if($rateW <= $rateH){
				$rate = $rateW;
			}else{
				$rate = $rateH;
			}
			$this->newWidth = $this->imageInfo["width"] * $rate;
			$this->newHeight = $this->imageInfo["height"] * $rate;
		}else{
			$this->newWidth = $this->imageInfo["width"];
			$this->newHeight = $this->imageInfo["height"];
		}
	}

	private function chkDoResize(){
		return (!empty($this->fileURL) && !empty($this->width) && !empty($this->height) && !empty($this->imageInfo)) ? true : false;
	}
	
	private function save($copy_id){
		switch($this->imageInfo['type']){
			case "png":
				imagepng($copy_id , $this->fileURL);
				break;
			case "gif":
				imagegif($copy_id , $this->fileURL);
				break;
			case "jpeg":
				imagejpeg($copy_id , $this->fileURL , $this->quality);
				break;
			default:
				break;
		}
	}
	
	private function prepareImage($type){
		$origin = null;
		$copy = null;
		switch($type){
			case "png":
				$origin = imagecreatefrompng($this->fileURL);
				$copy = imagecreatetruecolor($this->width , $this->height);
				$alpha = imagecolorallocatealpha($copy , 255 , 255 , 255 , 0);
				imagefilledrectangle($copy , 0 , 0 , $this->width , $this->height , $alpha);
				break;
			case "gif":
				$origin = imagecreatefromgif($this->fileURL);
				$copy = imagecreatetruecolor($this->width , $this->height);
				$alpha = imagecolorallocatealpha($copy , 255 , 255 , 255 , 0);
				imagefilledrectangle($copy , 0 , 0 , $this->width , $this->height , $alpha);
				break;
			case "jpeg":
				$origin = imagecreatefromjpeg($this->fileURL);
				$copy = imagecreatetruecolor($this->width , $this->height);
				break;
			default:
				break;
		}
		$id = array(
			"origin" => $origin,
			"copy" => $copy
		);
		return $id;
	}
	
	// For tablet (iPhone , android ...)
	private function rotate($id){
		$orientation = $this->imageInfo["Orientation"];
		switch($orientation){
			case 3:
				$id = imagerotate($id , 180 , 0);
				break;
			case 6:
				$id = imagerotate($id , 270 , 0);
				break;
			case 8:
				$id = imagerotate($id , 90 , 0);
				break;
			default:
				break;
		}
		return $id;
	}

	// For tablet (iPhone , android ...)
	private function exchangeWidthAndHeight($imageInfo){
		if(!empty($imageInfo["Orientation"])){
			switch($imageInfo["Orientation"]){
				case 6:
					$exchange = $imageInfo["width"];
					$imageInfo["width"] = $imageInfo["height"];
					$imageInfo["height"] = $exchange;
				break;
				case 8:
					$exchange = $imageInfo["width"];
					$imageInfo["width"] = $imageInfo["height"];
					$imageInfo["height"] = $exchange;
				break;
				default:
				break;
			}
		}
		return $imageInfo;
	}
}
?>