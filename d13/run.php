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
      $aInput = explode("\n", self::$sTest);
      if (286 == (self::parse2($aInput))) {
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
  }

}

abstract  class MetaWaypoint {
    public $iEast = 0, $iNorth = 0;
}
class Ship extends MetaWaypoint {

    /**
     * @var Waypoint
     */
    private $waypoint;

    public function __construct()
    {
        $this->waypoint = new Waypoint(10, 1);
    }

    public function navigate($aInput) {
        foreach ($aInput as $iLine => $sLine) {
            if (preg_match('/([NSEWLRF])(\d+)/', $sLine, $aMatches)) {
                list(, $sDirection, $iValue)    = $aMatches;
                $this->setDirection($sDirection, $iValue);
                var_dump(implode(" ", [$sDirection, $iValue,
                    ' ship: ', $this->iEast, 'e ', $this->iNorth, 'n ',
                    'waypoint', $this->waypoint->iEast, 'e, ', $this->waypoint->iEast]));
            } else {
                throw new Exception("line not found");
            }
        }
    }

    public function setDirection($sDirection, $iValue) {
        switch ($sDirection) {
            case 'N':
                $this->waypoint->iNorth += $iValue;
                break;
            case 'S' :
                $this->waypoint->iNorth -= $iValue;
                break;
            case 'E' :
                $this->waypoint->iEast += $iValue;
                break;
            case 'W' :
                $this->waypoint->iEast -= $iValue;
                break;
            case 'L':
            case 'R':
                $this->waypoint->rotate($sDirection, $iValue);
                break;
            case 'F':
                $this->iEast += $this->waypoint->iEast * $iValue;
                $this->iNorth += $this->waypoint->iNorth * $iValue;
                break;
            default;
                throw new Exception('souci de direction');
        }

    }
}
class Waypoint extends MetaWaypoint {

    public function __construct($iEast, $iNorth)
    {
        $this->iEast    = $iEast;
        $this->iNorth   = $iNorth;
    }

    public function rotate($sWise, $iValue) {
        $iEast  = $iNorth = 0;
        switch ($sWise) {
            case 'R' :
                switch ($iValue) {
                    case 90:
                        $iEast    = $this->iNorth;
                        $iNorth   = -1 * $this->iEast;
                        break;
                    case 180:
                        $iEast    = -1 * $this->iEast;
                        $iNorth   = -1 * $this->iNorth;
                        break;
                    case 270:
                        $iEast    = -1 * $this->iNorth;
                        $iNorth   = $this->iEast;
                        break;
                }
                break;
            case 'L' :
                switch ($iValue) {
                    case 90:
                        $iEast    = -1 * $this->iNorth;
                        $iNorth   = $this->iEast;
                        break;
                    case 180:
                        $iEast    = -1 * $this->iEast;
                        $iNorth   = -1 * $this->iNorth;
                        break;
                    case 270:
                        $iEast    = $this->iNorth;
                        $iNorth   = -1 * $this->iEast;
                        break;
                }
                break;

        }
        $this->iEast    = $iEast;
        $this->iNorth   = $iNorth;
    }
}
