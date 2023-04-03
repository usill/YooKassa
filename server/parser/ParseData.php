<?php
  require_once($_SERVER['DOCUMENT_ROOT']."/entities/Payment.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/entities/PaymentPosition.php");
  function parseData($data) 
  {
    $paymentsList = array();

    foreach($data->items as $item) // по чекам
    { 
      $payment = new Payment();
      $paymentPositionsList = array();

      $isRefund = $item->type == "refund";
      $recieptId = $isRefund && isset($item->refund_id) ? $item->refund_id : $item->payment_id;
      $operType = $isRefund ? 1 : 0;

      $time = strtotime($item->registered_at);
      $dateWithoutTime = explode("T", $item->registered_at)[0];
      $unixDate = strtotime($dateWithoutTime);
      
      $payment->trade_place = "null";
      $payment->trade_date = $time;
      $payment->nal = 0;
      $payment->beznal = 0;
      $payment->oper_type = $operType;
      $payment->reciept_id = $recieptId;
      $payment->wo_time = $unixDate;

      foreach($item->items as $positionItem) 
      {

        $paymentPosition = new PaymentPosition();
        $sumPrice = $positionItem->amount->value * $positionItem->quantity;

        $paymentPosition->item_name = $positionItem->description;
        $paymentPosition->quant = $positionItem->quantity;
        $paymentPosition->sum = 0;
        $paymentPosition->sum_beznal = $sumPrice;
        $paymentPosition->ticket_id =  $recieptId;

        $payment->beznal += $sumPrice;

        array_push($paymentPositionsList, $paymentPosition);
      }

      
      $payment->PaymentPositions = $paymentPositionsList;

      array_push($paymentsList, $payment);
    }

    return $paymentsList;
  }
?>