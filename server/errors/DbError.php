<?php
  require_once("ErrorBase.php");
  interface IDbError
  {
    public function getConnectDbError();
  }
  class DbError extends ErrorBase implements IDbError
  {
    public function __construct($message = "", $code = 0, $file = "") 
    {
      $this->message = $message;
      $this->code = $code;
      $this->file = $file;
    }
    public function getConnectDbError() 
    {
      $this->message = "Connect database error";
      $this->code = 2003;
      $this->file = "DbConnect.php";

      return $this->writeException();
    }
  }
?>