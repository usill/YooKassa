<?php
  require_once("ErrorBase.php");
  class UMoneyApiError extends ErrorBase
  {
    public function __construct($message = "", $code = 0, $file = "") 
    {
      $this->message = $message;
      $this->code = $code;
      $this->file = $file;
    }
  }
?>