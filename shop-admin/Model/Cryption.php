<?php
	/* * *****************************************************************************
	 * file: Cryption.php
	 * @autor: Thorn sereyvong
	 * @date: 07-09-2015
	 * Balancika co.,ltd
	 * Description: For Encrypt and Descrypt data 
	 * ***************************************************************************** */
	Class Cryption{
		private $key;
		private $key_size;
		private $iv_size;
		private $iv;
		
		private $bPassword;
		private $sPassword;
		private $Password = "Bal!@#$%^AME";
		
		private $ky = 'lkirwf897+22#bbtrm8814z5qq=498j5'; // 32 * 8 = 256 bit key
		private $iv_bal = '741952hheeyy66#cs!9hjv887mxx7@8y'; // 32 * 8 = 256 bit iv
		
		
		
		public function __construct(){
			$this->key = base64_encode("AME@Balancika.com");
			$this->key_size = strlen($this->key);
			$this->iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
			$this->iv = mcrypt_create_iv($this->iv_size, MCRYPT_RAND);
			
			
			$this->bPassword  = md5(utf8_encode($this->Password),TRUE);
			$this->bPassword .= substr($this->bPassword,0,8);
			$this->sPassword - $this->Password;
			
			
		}
		public function IEncrypt($str){
			$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key,$str, MCRYPT_MODE_CBC, $this->iv);
			$ciphertext = $this->iv.$ciphertext;
			return trim($this->isubStr(base64_encode($ciphertext),1));
		}
		public function IDecrypt($str){
			$ciphertext_dec = base64_decode($this->isubStr($str,0));
			$iv_dec = substr($ciphertext_dec, 0, $this->iv_size);
			$ciphertext_dec = substr($ciphertext_dec, $this->iv_size);
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key,$ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec));
		}
		public function isubStr($str,$option){
			if($option==1) 
				return substr($str, 5,15).substr($str, 0,5).substr($str, 37,7).substr($str, 16,21);
			return substr($str, 15,5).substr($str, 0,15).substr($str, 31,21).substr($str, 20,7);
		}
		public function IMD5($str){
			return substr(md5($str), 5,15);
		}
		
		public function Password($Password = "") {
			if($Password == "") {
				return $this->sPassword;
			} else {
				$this->bPassword  = md5(utf8_encode($Password),TRUE);
				$this->bPassword .= substr($this->bPassword,0,8);
				$this->sPassword - $Password;
			}
		}
		
		public function PasswordHash() {
			return $this->bPassword;
		}
		
		public function BalEncrypt_old($Message, $Password = "") {
		
			if($Password <> "") { $this->Password($Password); }
				
			if($Message == ""){  $Message = "Bal!@#$%^AME"; }
				
			$Message = substr($this->balEncryptRJ256($this->ky, $this->iv_bal, $Message),8,15);
				
			$size=mcrypt_get_block_size('tripledes','ecb');
			$padding=$size-((strlen($Message)) % $size);
			$Message .= str_repeat(chr($padding),$padding);
			$encrypt  = mcrypt_encrypt('tripledes',$this->bPassword,$Message,'ecb');
			return base64_encode($encrypt);
		}
		
		public function balEncryptRJ256($key,$iv_bal,$string_to_encrypt){
			$rtn = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string_to_encrypt, MCRYPT_MODE_CBC, $iv_bal);
			$rtn = base64_encode($rtn);
			return($rtn);
		}
		
		public $key1 = "Bal123_!@#ancika";
		public $key2 = "akicna#@!_321laB";	
			
		public function isub($str){
			$str = $this->generateRandomString($length = 10);
			return substr($str,5,5);
		}		
		public function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		public function BalEncrypt($str){
			global $key1,$key2;
			$s1 = $this->isub(base64_encode($key1)).''.base64_encode($str).''.$this->isub(base64_encode($key2));
			$s1 = base64_encode($s1);
			return $s1;
		}
		public function BalDecrypt($str){
			global $key1,$key2;
			$s1 = base64_decode($str);
			$s1 = str_replace(substr($s1,0,5),'', $s1);
			$s1 = str_replace(substr($s1,-5),'', $s1);
			$s1 = base64_decode($s1);
			return $s1;
		}
	}