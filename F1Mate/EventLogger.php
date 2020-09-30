<?php
/**
 * File Name     : EventLogger.php
 * Published by  : F1Mate
 * Publisher URL : https://f1mate.com
 * Contributors  : f1mate, 1amitgupta (Github)
 * Version       : v1.01
 * Licence       : MIT
 * Github URL    : https://github.com/f1mate/EventLogger
 */

/**
 * Remove comments
 * When you are using any framework
 * i.e. Laravel
 */
//namespace App\F1Mate;
//use Exception;

define('F1_ERROR', 'error_');
define('F1_INFO', 'info_');
define('F1_SUCCESS', 'success_');
define('F1_NOTICE', 'notice_');
define('F1_WARNING', 'warning_');
define('F1_EXCEPTION', 'exception_');
define('F1_LOG_PATH', '/logs');
define('F1_TIMEZONE', 'Asia/Kolkata');

class EventLogger
{

  private $type;
  private $path;
  private $chmode;

  public function __construct()
  {
    $this->type = '';
    $this->chmod = 0750;
    $this->path = $_SERVER['DOCUMENT_ROOT'] . F1_LOG_PATH;
  }

  public function success()
  {
    $this->type = F1_SUCCESS;
    return $this;
  }

  public function error()
  {
    $this->type = F1_ERROR;
    return $this;
  }

  public function info()
  {
    $this->type = F1_INFO;
    return $this;
  }

  public function notice()
  {
    $this->type = F1_NOTICE;
    return $this;
  }

  public function warning()
  {
    $this->type = F1_WARNING;
    return $this;
  }

  public function exception()
  {
    $this->type = F1_EXCEPTION;
    return $this;
  }

  /**
   * Create logs.
   * @param type $event_name
   * @param type $msg
   */
  public function log($event_name, $msg)
  {

    try {
      date_default_timezone_set(F1_TIMEZONE);
      $this->mkdirF1Mate($this->path, $this->chmode);
      $content = "DATE:: " . date('D d-M-Y') . " || TIME:: " . date('H:i:s') . " || IP:: " . trim($_SERVER['REMOTE_ADDR']) . " || " . $event_name . ":: " . $msg . "\r\n";
      $fp = fopen($this->getFileName($event_name), 'a');
      fwrite($fp, $content);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  private function getFileName($event_name)
  {
    $event_name = strtolower(str_replace(' ', '_', $event_name));
    return $this->path . "/" . $this->type . $event_name . '_log_' . date('Y_m_d') . '.log';
  }

  private function mkdirF1Mate($path, $chmode = 0750)
  {
    if (!is_dir($path)) {
      mkdir($path, 0750, true);
    }
  }
}