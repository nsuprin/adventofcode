<?php
class D13 {

  private static $sTest = <<< TEST
939
7,13,x,x,59,x,31,19
TEST;

  private static $sInput = <<< INPUT
1000511
29,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,37,x,x,x,x,x,409,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,17,13,19,x,x,x,23,x,x,x,x,x,x,x,353,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,41
INPUT;


  /**
   * RUN
   */
  public static function run() {
    $aInput = explode("\n", self::$sInput);
    var_dump((self::parse($aInput)));
  }

  public static function test() {
    $aInput = explode("\n", self::$sTest);
    if (295 == (self::parse($aInput))) {
      var_dump('OK');
    } else {
      var_dump('KO');
    }
  }

    public static function run2() {
        $aInput = explode("\n", self::$sInput);
        var_dump(self::parse2($aInput));
    }

  public static function test2() {

      $aInput = explode("\n", "0\n17,x,13,19");
      if (3417 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
      $aInput = explode("\n", "0\n67,7,59,61");
      if (754018 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
      $aInput = explode("\n", "0\n67,x,7,59,61");
      if (779210 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
      $aInput = explode("\n", "0\n67,7,x,59,61");
      if (1261476 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
      $aInput = explode("\n", "0\n1789,37,47,1889");
      if (1202161486 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
      $aInput = explode("\n", self::$sTest);
      if (1068781 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
  }

    /**
     * @param $aInput
     */
  public static function parse($aInput) {
      list($iErliestTimestamp, $sBuses) = $aInput;
      $aBuses   = explode(',', str_replace('x,', '', $sBuses));
      var_dump([$iErliestTimestamp, $aBuses]);
      asort($aBuses);
      $bContinue    = true;
      $iTimestamp   = $iErliestTimestamp;
      do {
          foreach ($aBuses as $iBus) {
              if (0 == $iTimestamp % $iBus) {
                  $bContinue    = false;
                  break 2;
              }
          }
          $iTimestamp++;
      } while ($bContinue);
      return $iBus * ($iTimestamp - $iErliestTimestamp);
      //var_dump([$iBus, $iTimestamp]);
  }

  /**
   * @param $aInput
   * @return mixed
   */
  public static function parse2($aInput) {
      list(, $sBuses) = $aInput;
      $aBuses   = [];
      foreach (explode(',', $sBuses) as $iDelta => $iBus) {
          if ('x' == $iBus) {
              continue;
          }
          $aBuses[$iDelta]  = $iBus;
      }

      $iStepSize    = array_values($aBuses)[0];

      unset($aBuses[array_keys($aBuses)[0]]);
      $iCurrentTimestamp    = 0;

      foreach ($aBuses as $iDeltabus => $iBus) {
          while (0 == ($iCurrentTimestamp + $iDeltabus) || 0 != ($iCurrentTimestamp + $iDeltabus) % $iBus) {
              $iCurrentTimestamp    += $iStepSize;
          }
          $iStepSize    *= $iBus;
      }
      return $iCurrentTimestamp;
  }

}