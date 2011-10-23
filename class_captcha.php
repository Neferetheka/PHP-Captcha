<?php
session_start();


class captcha
{


	public function __contruct()
	{
	
	}
	
	public function save()
	{
		
	
		$length = 5;
		
		$code = self::alea_char($length);
		$hashCode = sha1($code);
		
		
		for($i = 1; $i < $length+1; $i++)
		{
			$chaine = 'char'.$i;
			$$chaine = substr($code, $i-1, 1);
		}
		
		
		$image = imagecreatefrompng('captcha.png');
		
		$colors=array ( imagecolorallocate($image, 131,154,255),
		imagecolorallocate($image, 89,186,255),
		imagecolorallocate($image, 155,190,214),
		imagecolorallocate($image, 255,128,234),
		imagecolorallocate($image, 255,123,123) );
		
		for($i = 1; $i < $length+1; $i++)
		{
			$chaine = 'char'.$i;
			imagettftext($image, 28, rand(-15, 15), 30*$i-30, 37, self::random($colors), 'fonts/arial.ttf', $$chaine);
		}
		
		$_SESSION['Captcha'] = $hashCode;
		
		
		header('Content-Type: image/png');
		imagepng($image);
		imagedestroy($image);
	
	}
	
	
	private function alea_char($length) 
	{
	
		$chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; 
		
		$rand_str = '';
		
		for ($i=0; $i<$length; $i++) 
		
			$rand_str .= $chars{ mt_rand( 0, strlen($chars)-1 ) };
		
		
		return $rand_str;
	}
	
	private function random($tab) {
	return $tab[array_rand($tab)];
	}

}



$myCaptcha = new captcha();
$myCaptcha->save();

?>