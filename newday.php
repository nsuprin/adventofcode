#!/usr/bin/env php
<?php
list(,$day) = $argv;
if (!isset($day)) {
  throw new Exception('day param required');
}
$day  = strtolower($day);
if (is_dir($day)) {
  throw new Exception('day allready exists');
}
mkdir($day);
$sFile  = $day.'/run.php';
copy('assets/Sample.php', $sFile);
$sContent = file_get_contents($sFile);
$sContent = str_replace('Sample', ucfirst($day), $sContent);
file_put_contents($sFile, $sContent);
