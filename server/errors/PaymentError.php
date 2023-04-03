<?php
  require_once("ErrorBase.php");
  interface IPaymentError 
  {
    public function getPaymentItemError();
    public function getPaymentPositionItemError();
  }
  class PaymentError extends ErrorBase implements IPaymentError
  {
    public function __construct($message = "", $code = 0, $file = "") 
    {
      $this->message = $message;
      $this->code = $code;
      $this->file = $file;
    }
    
    public function getPaymentItemError() 
    {
      $this->message = "Send payment error";
      $this->code = 2001;
      $this->file = "PaymentController.php";

      return $this->writeException();
    }
    public function getPaymentPositionItemError() 
    {
      $this->message = "Send payment position(item) error";
      $this->code = 2002;
      $this->file = "PaymentController.php";

      return $this->writeException();
    }
    
  }
?>