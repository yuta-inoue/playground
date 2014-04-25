<?php
class ResizeImage {
	public function __construct(){
	}
	// 画像を必ず指定したサイズにリサイズする
	public function resize_absolute($fileURL , $width , $height){
	
		$image = $this->getImageInfo($fileURL);
		$image = $this->exchangeWidthAndHeight($image);
		
		if(!empty($fileURL) && !empty($width) && !empty($height) && !empty($image)){
			
			$rate_w = $width / $image["width"];
			$rate_h = $height / $image["height"];
			
			if($rate_w <= $rate_h){
				$x = ($image["width"] - ($width * ($image["height"] / $height))) / 2;
				$y = 0;
				$width_temp = $image["width"] * $rate_h;
				$height_temp = $height;
			}else{
				$x = 0;
				$y = ($image["height"] - ($height * ($image["width"] / $width))) / 2;
				$width_temp = $width;
				$height_temp = $image["height"] * $rate_w;
			}
			//var_dump($x);
			//var_dump($y);
			$fileType = $image["type"];
			
			$id = $this->prepareImage($fileURL , $width , $height , $fileType);
			if(!empty($image["Orientation"])){
				$id["origin"] = $this->rotate($id["origin"] , $image["Orientation"]);
			}
			//var_dump($id);
			//var_dump($fileType);
			//imagecopyresampled($id["copy"] , $id["origin"] , 0 , 0 , $x , $y , $width_temp , $height_temp , $image["width"] , $image["height"]);
			imagecopyresized($id["copy"] , $id["origin"] , 0 , 0 , $x , $y , $width_temp , $height_temp , $image["width"] , $image["height"]);
			$copy_id = $id["copy"];
			$this->save($copy_id , $fileURL , $fileType);
			imagedestroy($id["copy"]);
			imagedestroy($id["origin"]);
		}else{}
	}
	
	
	// 画像を指定したサイズ以下にリサイズする
	public function resize($fileURL , $width , $height){
		
		$image = $this->getImageInfo($fileURL);
		$image = $this->exchangeWidthAndHeight($image);
		//var_dump($image);
		
		if(!empty($fileURL) && !empty($image) && (!empty($width) || !empty($height))){
			
			$rate_w = $width / $image["width"];
			$rate_h = $height / $image["height"];
			
			if($rate_w < 1 || $rate_h < 1){
				if($rate_w <= $rate_h){
					$rate = $rate_w;
				}else{
					$rate = $rate_h;
				}
				$width_temp = $image["width"] * $rate;
				$height_temp = $image["height"] * $rate;
			}else{
				$width_temp = $image["width"];
				$height_temp = $image["height"];
			}
			
			$fileType = $image["type"];
			$id = $this->prepareImage($fileURL , $width_temp , $height_temp , $fileType);
			if(!empty($image["Orientation"])){
				$id["origin"] = $this->rotate($id["origin"] , $image["Orientation"]);
			}
			//var_dump($id);
			imagecopyresized($id["copy"] , $id["origin"] , 0 , 0 , 0 , 0 , $width_temp , $height_temp , $image["width"] , $image["height"]);
			$copy_id = $id["copy"];
			$this->save($copy_id , $fileURL , $fileType);
			imagedestroy($id["copy"]);
			imagedestroy($id["origin"]);
		}else{}
	}
	/*
	// 画像のMIMEタイプを取得（png , jepg , gif , pdf など）し、拡張子を変換する
	public function getImageType($MIME){
		switch($MIME){
			case "image/png":
			$type = "png";
			break;
			
			case "image/gif":
			$type = "gif";
			break;
			
			case "image/jpeg":
			$type = "jpg";
			break;
			
			case "image/jpg":
			$type = "jpg";
			break;
			
			default:
			$type = "";
			break;
		}
		return $type;
	}
	*/
	
	// 画像を保存する
	private function save($copy_id , $fileURL , $fileType){
		switch($fileType){
			case "png":
			imagepng($copy_id , $fileURL);
			break;
			
			case "gif":
			imagegif($copy_id , $fileURL);
			break;
			
			case "jpeg":
			imagejpeg($copy_id , $fileURL , 90);
			break;
			
			default:
			break;
		}
	}
	
	
	// 画像IDを使用するための準備をする
	private function prepareImage($fileURL , $width , $height , $fileType){
		switch($fileType){
			case "png":
			$origin = imagecreatefrompng($fileURL);
			$copy = imagecreatetruecolor($width , $height);
			break;
			
			case "gif":
			$origin = imagecreatefromgif($fileURL);
			$copy = imagecreatetruecolor($width , $height);
			$alpha = imagecolorallocatealpha($copy , 255 , 255 , 255 , 0);
			imagefilledrectangle($copy , 0 , 0 , $width , $height , $alpha);
			break;
			
			case "jpeg":
			$origin = imagecreatefromjpeg($fileURL);
			$copy = imagecreatetruecolor($width , $height);
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
	
	
	// 画像の回転（iPhoneなど用）
	private function rotate($id , $orientation){
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
	
	// 画像の横幅と高さの値を入れ替える（iPhoneなど用）
	private function exchangeWidthAndHeight($image){
		if(!empty($image["Orientation"])){
			switch($image["Orientation"]){
				case 6:
					$exchange = $image["width"];
					$image["width"] = $image["height"];
					$image["height"] = $exchange;
				break;
				case 8:
					$exchange = $image["width"];
					$image["width"] = $image["height"];
					$image["height"] = $exchange;
				break;
				default:
				break;
			}
		}
		return $image;
	}
	
	
	// 画像ファイルの情報を配列に格納して返す
	public function getImageInfo($fileURL){

		$result = array();
		$arr = getimagesize($fileURL);

		$result["width"] = (!empty($arr[0])) ? $arr[0] : null;
		$result["height"] = (!empty($arr[1])) ? $arr[1] : null;
		$result["type"] = (!empty($arr[2])) ? image_type_to_extension($arr[2] , false) : null;
		$result["mime"] = (!empty($arr["mime"])) ? $arr["mime"] : null;
		//var_dump($result);
		foreach($result as $val){
			if(empty($val)){
				return false;
			}
		}
		$exif_data = (exif_imagetype($fileURL)) ? exif_read_data($fileURL) : null;
		$result["Orientation"] = (!empty($exif_data["Orientation"])) ? $exif_data["Orientation"] : null;
		//var_dump($result);
		return $result;
	}
}
?>