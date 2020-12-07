#!/usr/bin/env php
<?php
try {
  if (!isset($argv[1])) {
    throw new Exception('Param not found');
  }
  $sFile  = $argv[1].'/run.php';
  if (!is_file($sFile)) {
    throw new Exception('Day not found');
  }
  $sMethod  = 'run';
  if (isset($argv[2])) {
    $sMethod  = $argv[2];
  }
  require_once $sFile;
  $sClass = ucfirst($argv[1]);

  $sCall  = $sClass.'::'.$sMethod;
  if (!is_callable($sCall)) {
    throw new Exception('Unable to call method');
  }
  call_user_func_array($sCall, []);
} catch (Exception $oFault) {
  var_dump($oFault);
}
