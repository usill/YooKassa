<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <?php
			require(__DIR__."/db/DbConnect.php");
			require(__DIR__."/controllers/PaymentController.php");
			require(__DIR__."/controllers/UMoneyApiController.php");
			require(__DIR__."/parser/ParseData.php");
			require_once(__DIR__."/logger/Logger.php");
		
			$cursor = null;
			$result = null;
			$rows = 0;
			$paymentController = new PaymentController();
			$uMoneyApiController = new UMoneyApiController();
			$logger = new Logger();

			do 
			{
				$paymentsJson = $uMoneyApiController->getPaymentList($cursor);
				$cursor = isset($paymentsJson->next_cursor) ? $paymentsJson->next_cursor : null;
				$payments = parseData($paymentsJson);
				$result = $paymentController->SendPaymentList($payments);
				$rows += $result->countItems;
			} 
			while(isset($cursor));

			if($result->successed == true) 
			{
				$logger->setLog("В базу успешно внесены $rows позиций");
			}
			else 
			{
				$logger->setLog("Данные внесены в базу не полностью");
			}
		?>
</body>
</html>

