<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/db/DbConnect.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/services/PaymentService.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/errors/PaymentError.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/logger/Logger.php");
	interface IPaymentController 
	{
		public function SendPaymentList($data);
	}
	class PaymentController implements IPaymentController
	{
		private $paymentService = null;
		private $logger = null;
		public function __construct()
		{
			$this->paymentService = new PaymentService($this->logger);
			$this->logger = new Logger();
		}
		public function SendPaymentList($data) 
		{
			$connection = getConnection();
			$result = $this->paymentService->sendPayments($connection, $data);

			$connection->close();

			if($result->successed == true) 
			{
				$this->logger->setLog("Список чеков (до 100) успешно добавлен в базу");
				return $result;
			}
		}
	}
?>