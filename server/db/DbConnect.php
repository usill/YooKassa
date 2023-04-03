<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/errors/DbError.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/logger/Logger.php");
	
	function getConnection() 
	{
		try 
		{
			$connection = mysqli_connect(DB_URL, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if($connection->connect_error) 
			{
				$error = new DbError();
				$error->getConnectDbError();

				$logger = new Logger();
				$logger->setLog($error->getMessage());
			};

			return $connection;
		}
		catch(Exception $e)
		{
			$err = new DbError($e->getMessage(), $e->getCode(), $e->getFile());
			$err->getUndefinedError();

			$logger = new Logger();
			$logger->setLog($e->getMessage());
		}
	}
?>