<?php

	require_once($_SERVER['DOCUMENT_ROOT']."/errors/PaymentError.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/logger/Logger.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entities/results/SendPaymentListResult.php");
  interface IPaymentService
  {
		public function sendPayments($connection, $data);
  }
  class PaymentService implements IPaymentService
  {
		private $logger = null;
		public function __construct($logger) 
		{
			$this->logger = $logger;
		}
		public function sendPayments($connection, $data)
		{
			$countRows = 0;
			foreach($data as $row) 
				{
					$isUnique = $this->sendPaymentItem($connection, $row);

					if($isUnique == false) 
					{
						continue;
					}

					if(is_object($row)) 
					{
						foreach($row->PaymentPositions as $position) 
						{
							$resultPos = $this->sendPaymentPositionItem($connection, $position, $row->reciept_id);

							if(!isset($resultPos)) 
							{
								$err = new PaymentError();
								$err->getPaymentPositionItemError();

								$this->logger->setLog(
									$err->getMessage().
									"В файле: ".$err->getFile().
									"на строке: ".$err->getLine()
								);

								$result = new SendPaymentListResult();
								$result->successed = false;
								return $result;
							};
						}
					}
					$countRows++;
				}
			
			$result = new SendPaymentListResult();
			$result->countItems = $countRows;
			$result->successed = true;

			return $result;
		}
    private function sendPaymentItem($connection, $item) 
    {
			$isUnique = $this->isUnique($connection, $item->reciept_id);

			if($isUnique == false) 
			{
				return false;
			}

			$sql = "INSERT INTO `dashdata` 
			(
				rdzv, 
				termina, 
				trade_place, 
				trade_date, 
				nal, 
				beznal, 
				oper_type, 
				reciept_id, 
				wo_time,
				quant,
				field1,
				is_correct
			) 
			VALUES (
				'$item->rdzv', '$item->termina', '$item->trade_place', '$item->trade_date', '$item->nal', 
				'$item->beznal', '$item->oper_type', '$item->reciept_id', 
				'$item->wo_time', '$item->quant', '$item->field1', '$item->is_correct'
			)";
      return $connection->query($sql);
    }
		private function isUnique($connection, $reciept_id) 
		{
			$sql = "SELECT * FROM `dashdata` WHERE reciept_id = '$reciept_id'";
			
			$result = $connection->query($sql);

			if($result->num_rows > 0) 
			{
				return false;
			}

			return true;
		}
    private function sendPaymentPositionItem($connection, $posItem, $reciept_id) 
    {
      $sql = "INSERT INTO `ticket_items` (
          item_name,
					quant,
					sum,
					sum_bnal,
					ticket_id
					
				) VALUES (
					'$posItem->item_name', '$posItem->quant', 
					'$posItem->sum', '$posItem->sum_beznal', '$reciept_id'
				);
			";
        
      return $connection->query($sql);
    }
  }
?>