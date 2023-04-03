<?php
	class Payment 
	{
		public $rdzv = "null";
		public $termina = "null";
		public $trade_place;
		public $trade_date;
		public $nal;
		public $beznal;
		public $oper_type;
		public $reciept_id;
		public $wo_time;
		public $type;
		public $quant = 0;
		public $field1 = "null";
		public $is_correct = "null";
		public $PaymentPositions; // list<PaymentPosition>
	}
?>