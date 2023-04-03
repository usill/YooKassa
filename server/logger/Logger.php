<?php
  class Logger 
  {
    public function setLog($message) 
    {
      $time = new DateTime();
      $dateWoTime = new DateTime();

      $formTime = $time->format("H:i:s");
      $formDate = $dateWoTime->format("Y-m-d");

      $file = fopen("log/log-$formDate.txt", "a");
      fwrite($file, "$formTime Message: $message" . PHP_EOL);

      fclose($file);
    }
  }
?>