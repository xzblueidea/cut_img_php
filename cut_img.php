<?php
/*
by:Fireflyi
time:2016-3-4
Here only provides the basic idea and principle
*/
class cut_imgs{
	private $path,$name;
	function __construct($path='./',$name='cut.jpg'){
		$this->path = $path;
		$this->name = $name;
	}
	function ini(){
		if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],rtrim($this->path).'/'.$this->name)){
			$info = $this->xx_img($this->path,$this->name,$_POST['x1'],$_POST['y1'],$_POST['w'],$_POST['h'],$fina_w='',$fina_h='');	
				echo $info;
		}
		var_dump($_FILES);
		var_dump($_POST);
	}
	//php裁剪函数
	function xx_img($path,$img_name,$x,$y,$w,$h,$fina_w='',$fina_h=''){
		$img = imagecreatefromstring(file_get_contents($path.$img_name));
		if($fina_w==''){$fina_w = $w;}
		if($fina_h==''){$fina_h = $h;}
		$new_img = imagecreatetruecolor($fina_w,$fina_h);
		imagecopyresampled($new_img,$img,0,0,$x,$y,$w,$h,$fina_w,$fina_h);
		unlink($path.$img_name);
		imagepng($new_img,$path.$img_name);
		return '上传裁剪成功！图片路径: '.$path.$img_name;
	}
}
$i = new cut_imgs('./','cut.jpg');
$i->ini();
?>