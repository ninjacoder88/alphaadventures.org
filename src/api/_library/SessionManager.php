<?php
class SessionManager
{
	public function __construct()
	{
		if(isset($_SESSION))
		{
			return;
		}
		session_start();
	}
	
	private $SessionVariableNameWebsiteUserId = "alphaadventures_websiteuserid";
	private $SessionVariableNameUsername = "alphaadventures_username";
	private $SessionVariableNameLastActionTime = "alphaadventures_lastactiontime";
	private $SessionVariableNameMessage = "alphaadventures_message";
	private $SessionVariableNameTheme = "alphaadventures_theme";
	private $SessionVariableNameAdmin = "alphaadventures_admin";
	
	public function ExpireSession()
	{
		unset($_SESSION[$this->SessionVariableNameWebsiteUserId]);
		unset($_SESSION[$this->SessionVariableNameLastActionTime]);
	}

	public function GetLastActionTime()
	{
		return $_SESSION[$this->SessionVariableNameLastActionTime];
	}
	
	public function GetMessage()
	{
		if(isset($_SESSION[$this->SessionVariableNameMessage]))
		{
			return $_SESSION[$this->SessionVariableNameMessage];
		}
		return "";
	}

	public function GetTheme()
	{
		if(isset($_SESSION[$this->SessionVariableNameTheme]))
		{
			return $_SESSION[$this->SessionVariableNameTheme];
		}
		return "default";
	}
	
	public function GetUsername()
	{
		return $_SESSION[$this->SessionVariableNameUsername];
	}

	public function GetWebsiteUserId()
	{
		if(isset($_SESSION[$this->SessionVariableNameWebsiteUserId]))
		{
			return $_SESSION[$this->SessionVariableNameWebsiteUserId];
		}
		return null;
	}
	
	public function IsAdmin()
	{
		if(isset($_SESSION[$this->SessionVariableNameAdmin]))
		{
			if($_SESSION[$this->SessionVariableNameAdmin] == "true")
			{
				return true;
			}
		}
		return false;
	}

	public function IsExpired()
	{
		$now = time();
		$lastActionTime = $_SESSION[$this->SessionVariableNameLastActionTime];
		
		if($now - $lastActionTime > 60 * 30)
		{
			return true;
		}
		return false;
	}
	
	public function IsLoggedIn()
	{
		$loggedIn = 
			isset($_SESSION[$this->SessionVariableNameWebsiteUserId]) 
			&& isset($_SESSION[$this->SessionVariableNameLastActionTime]);
		return $loggedIn;
	}
	
	public function StayAlive()
	{
		$_SESSION[$this->SessionVariableNameLastActionTime] = time();
	}
	
	public function SetAdmin()
	{
		$_SESSION[$this->SessionVariableNameAdmin] = true;
	}
	
	public function SetMessage($message)
	{
		$_SESSION[$this->SessionVariableNameMessage] = $message;
	}

	public function SetTheme($theme)
	{
		$_SESSION[$this->SessionVariableNameTheme] = $theme;
	}
	
	public function SetUsername($username)
	{
		$_SESSION[$this->SessionVariableNameUsername] = $username;
	}
	
	public function SetWebsiteUserId($websiteUserId)
	{
		$_SESSION[$this->SessionVariableNameWebsiteUserId] = $websiteUserId;
	}

	public function ValidateSessionForAPI()
	{
		$loggedIn = $this->IsLoggedIn();

		if($loggedIn)
		{
			$isExpired = $this->IsExpired();
			if($isExpired)
			{
				$this->ExpireSession();
				$this->SetMessage("session has expired");
				return array("success" => "exit", "message" => "session has expired");
				//exit();
			}
			$this->StayAlive();
			return array("success" => "true", "websiteUserId" => $this->GetWebsiteUserId());
		}
		else
		{
			return array("success" => "exit", "message" => "not logged in");
			//exit();
		}
	}
}
?>