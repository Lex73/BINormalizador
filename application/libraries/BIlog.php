<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bilog
{
  protected $ci;

  function __construct()
  {
      $this->ci =& get_instance();
  }

  public function escribeLog($texto,$archivo)
  {
      $hoy = date("Ymd");
      $ahora = date("H:i:s");
      $file = fopen($this->ci->config->item('FOLLG').'LOG_'.$archivo.'_'.$hoy.'.txt', "a");
      fwrite($file,'-------------------------------------------------------------'.PHP_EOL);
      fwrite($file,$ahora.' : '.$texto.PHP_EOL);
      fwrite($file,'-------------------------------------------------------------'.PHP_EOL);
      fclose($file);
  }
}
?>
