<?php
  interface IErrorBase 
  {
    public function getUndefinedError();
  }
  class ErrorBase extends Exception implements IErrorBase
  {
    protected function writeException() 
    {
      echo "Error or warning --- message: $this->message; code: $this->code; file: $this->file";
      return $this;
    }
    public function getUndefinedError() 
    {
      return $this->writeException();
    }
  }
?>    