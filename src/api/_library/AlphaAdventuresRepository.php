<?php
class AlphaAdventuresRepository
{
    function __construct()
    {
        try
		{
			$documentRoot = dirname(dirname(dirname(__FILE__)));
			$fileLines = file($documentRoot . "/api/_library/connection.config", FILE_IGNORE_NEW_LINES);
			$this->serverHost = $fileLines[0];
			$this->serverDatabase = $fileLines[1];
			$this->serverUsername = $fileLines[2];
			$this->serverPassword = $fileLines[3];
		}
		catch(Throwable $e){
			$this->HandleException($e);
		}
    }

    protected function Fetch($sql, $array)
	{
		try
		{
			$dbh = $this->CreateDatabaseHandler();
			$stmt = $dbh->prepare($sql);
			
			foreach($array as $key => $value)
			{
				$stmt -> bindValue($key,$value);
			}
			
			$stmt -> execute();
			
			$result = $stmt -> fetch();
			
			$errorInfoDBH = $dbh -> errorInfo();
			$errorInfoSTMT = $stmt -> errorInfo();
			
			$stmt = null;
			$dbh = null;
			
			return $result;
		}
		catch(Throwable $e)
		{
			$this->HandleException($e);
			return null;
		}
	}

	protected function FetchAll($sql, $array)
	{
		try
		{
			$dbh = $this->CreateDatabaseHandler();
			$stmt = $dbh->prepare($sql);
			
			foreach($array as $key => $value)
			{
				$stmt -> bindValue($key,$value);
			}
			
			$stmt -> execute();
			
			$results = $stmt -> fetchAll();
			
			$errorInfoDBH = $dbh -> errorInfo();
			$errorInfoSTMT = $stmt -> errorInfo();
			
			$stmt = null;
			$dbh = null;
			
			return $results;
		}
		catch(Throwable $e)
		{
			$this->HandleException($e);
			return null;
		}
	}

	protected function Update($sql, $array)
	{
		try
		{
			$dbh = $this->CreateDatabaseHandler();
			$stmt = $dbh->prepare($sql);
			
			foreach($array as $key => $value)
			{
				$stmt -> bindValue($key,$value);
			}
			
			$stmt -> execute();
			
			$errorInfoDBH = $dbh -> errorInfo();
			$errorInfoSTMT = $stmt -> errorInfo();
			
			$stmt = null;
			$dbh = null;
		}
		catch(Throwable $e)
		{
			$this->HandleException($e);
			return null;
		}
	}
	
	protected function Insert($sql, $array)
	{
		try
		{
			$dbh = $this->CreateDatabaseHandler();
			$stmt = $dbh->prepare($sql);
			
			foreach($array as $key => $value)
			{
				$stmt -> bindValue($key,$value);
			}
			
			$stmt -> execute();
			
			$id = $dbh->lastInsertId();
			
			$errorInfoDBH = $dbh -> errorInfo();
			$errorInfoSTMT = $stmt -> errorInfo();
			
			$stmt = null;
			$dbh = null;
			
			return $id;
		}
		catch(Throwable $e)
		{
			$this->HandleException($e);
			return null;
		}
	}
	
	protected function CreateDatabaseHandler()
	{
		$databaseHandler = new PDO("mysql:host=".$this->serverHost.";dbname=".$this->serverDatabase,$this->serverUsername,$this->serverPassword);
		$databaseHandler -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $databaseHandler;
	}
	
	protected function HandleException($exception)
	{
		$fileContents = 
			array(
				"time" => date("Y-m-d H:i:s"),
				"message" => $exception -> getMessage(),
				"trace" => $exception -> getTraceAsString()
				);
		
		$url = "https://tomharrisonline.com/logging/alphaadventures.php";
		$json = urlencode(json_encode($fileContents));
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
		$result = curl_exec($ch);
		curl_close($ch);
	}

	private $serverHost;
	private $serverDatabase;
	private $serverUsername;
	private $serverPassword;
}
?>