<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/errors/UMoneyApiError.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/logger/Logger.php");

	interface IUMoneyApiController
	{
		public function getPaymentList($cursor);
	}
	class UMoneyApiController implements IUMoneyApiController
	{
		private $logger = null;
		public function __construct() 
		{
			$this->logger = new Logger();
		}
		public function getPaymentList($cursor = null) 
		{
			try 
			{
				$date = $this->getDateTime();
				$url = "https://api.yookassa.ru/v3/receipts?created_at.gte=$date&limit=".LIMIT_VALUE;
				$id = MARKET_ID;
				$key = SECRET_KEY;

				if(isset($cursor)) 
				{
					$url .= "&cursor=$cursor";
				}

				$init = curl_init();
				curl_setopt($init, CURLOPT_URL, $url);
				curl_setopt($init, CURLOPT_USERPWD, $id . ":" . $key);
				curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
			
				return json_decode(curl_exec($init));
			}
			catch(Exception $e) 
			{
				$err = new UMoneyApiError($e->getMessage(), $e->getCode(), $e->getFile());
				$err->getUndefinedError();

				$this->logger->setLog($err->getMessage());
			}
		}
		private function getDateTime() 
			{
				$date = new DateTime();
				$date->modify('-' . DATE_RANGE . ' day');
				$date->setTime(DATE_HOURS, DATE_MINUTS, 0);
				$modifyDate = $date->format(DateTime::ATOM);
				return explode("+", $modifyDate)[0] . ".000Z";
			}
		
	}
?>