<?php
class EncryptionManager
{
	private $LOWERCASEMIN = 97;
	private $LOWERCASEMAX = 122;
	private $UPPERCASEMIN = 65;
	private $UPPERCASEMAX = 90;
	private $NUMBERSMIN = 48;
	private $NUMBERSMAX = 57;

	public function GenerateSalt()
	{
		return $this->GenerateRandomCharacters(5, true, true, true, false);
	}

	public function GenerateUserKey()
	{
		return $this->GenerateRandomCharacters(15, true, true, true, false);
	}

	public function HashEncrypt($data)
	{
		return bin2hex(mhash(MHASH_SHA512, $data));
	}
	
	private function GenerateRandomCharacters($stringLength, $lowercase, $uppercase, $numbers, $specialCharacters)
	{
		$generatedPassword = "";
		
		while(strlen($generatedPassword) < $stringLength)
		{
			$r = rand(1,4);
			if($r == 1 && $lowercase)
			{
				$generatedPassword .= chr(rand($this->LOWERCASEMIN, $this->LOWERCASEMAX));
				continue;
			}
			if($r == 2 && $uppercase)
			{
				$generatedPassword .= chr(rand($this->UPPERCASEMIN, $this->UPPERCASEMAX));
				continue;
			}
			if($r == 3 && $numbers)
			{
				$generatedPassword .= chr(rand($this->NUMBERSMIN, $this->NUMBERSMAX));
				continue;
			}
			if($r == 4 && $specialCharacters)
			{
				$generatedPassword .= $this->GenerateSpecialCharacter();
				continue;
			}
		}
		
		return $generatedPassword;
	}
	
	private function GenerateSpecialCharacter()
	{
		$specialCharacters = array(1 => "!", 2 => "@", 3 => "#", 4 => "$", 5 => "%", 6 => "^", 7 => "&", 8 => "*", 9 => "?", 10 => "<", 11 => ">", 12 => "+", 13 => "-", 14 => "_", 15 => "=");
		
		$v = rand(1,15);
		return $specialCharacters[$v-1];
	}
}
?>