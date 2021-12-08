<?php


class D08 extends Day
{

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $iNbValidDigit  = 0;
    foreach ($aInput as $sLine) {
      if (empty($sLine)) {
        continue;
      }
      list(,$sOutputValues) = explode(' | ', $sLine);
      $aOutputValues  = explode(' ', $sOutputValues);
      foreach ($aOutputValues as $sOutputValue) {
        $iDigit = $this->bind(strlen($sOutputValue));
        if (!empty($iDigit)) {
          $iNbValidDigit++;
        }
      }
    }
    return $iNbValidDigit;
  }

  /**
   * @param $iSize
   * @return int
   */
  private function bind($iSize) {
    $iReturn = null;
    $aBind = [
      2 => 1,
      4 => 4,
      3 => 7,
      7 => 8,
    ];
    if (isset($aBind[$iSize])) {
      $iReturn = $aBind[$iSize];
    }
    return $iReturn;
  }



  /**
   * TEST
   */
  public function test2a() {
    $iResult = $this->parse2(["acedgfb cdfbe gcdfa fbcad dab cefabd cdfgeb eafb cagedb ab | cdfeb fcadb cdfeb cdbaf"]);
    if (5353 == $iResult) {
      var_dump('OK');
    } else {
      var_dump('KO');
    }
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $iReturn = 0;
    foreach ($aInput as $sLine) {
      if (empty($sLine)) {
        continue;
      }
      list($sUniqueSignelPattern,$sOutputValues) = explode(' | ', $sLine);
      $aUniqueSignelPattern  = explode(' ', $sUniqueSignelPattern);
      $aOutputValues  = explode(' ', $sOutputValues);
      //var_dump($aUniqueSignelPattern);
      $aPatterns  = [];
      $aUnknowedPatterns = [];
      foreach ($aUniqueSignelPattern as $sPattern) {
        $iDigit = $this->bind(strlen($sPattern));
        $aPattern = str_split($sPattern);
        asort($aPattern);
        if (!empty($iDigit)) {
          $aPatterns[$iDigit] = $aPattern;
        } else {
          $aUnknowedPatterns[implode('', $aPattern)]  = $aPattern;
        }
      }
      // --- choppe le segment du haut
      $aTopSegment = array_diff($aPatterns[7], $aPatterns[1]);

      // --- debut de 9 qui est un basé sur un 4
      $aPatterns[9] = $aPatterns[4];


      // --- debut de 0 qui à un morceau de 1
      //$aPatterns[0] = $aPatterns[1];


      // -- choppe le segmeent du bas
      $aCommonSegments = call_user_func_array('array_intersect', $aUnknowedPatterns);
      $aBottomSegment = array_diff($aCommonSegments, $aTopSegment);


      // ajout du segment du haut et du bas sur tout les autres chiffres
      foreach ([9] as $item) {
        if (!isset($aPatterns[$item])) {
          $aPatterns[$item] = [];
        }
        $aPatterns[$item] = array_merge(
          $aPatterns[$item],
          $aTopSegment
        );
        $aPatterns[$item] = array_merge(
          $aPatterns[$item],
          $aBottomSegment
        );
        asort($aPatterns[$item]);
      }
      // ici on a un 9 complet maintenant, je le dégage des inconnus
      unset($aUnknowedPatterns[implode('', $aPatterns[9])]);

      /*var_dump($aUnknowedPatterns);
      exit();*/

      // si je fais une diff du patern incconu avec le 1 alors je sais que c'est un 3
      foreach ($aUnknowedPatterns as $aUnknowedPattern) {
        $aTmpPatern = array_diff($aUnknowedPattern, $aPatterns[1]);
        if (sizeof($aTmpPatern) == 3) {
          $aPatterns[3] = $aUnknowedPattern;
          unset($aUnknowedPatterns[implode('', $aPatterns[3])]);
          break;
        }
      }

      // si je fais une diff du patern incconu avec le 1 alors je sais que c'est un 6
      foreach ($aUnknowedPatterns as $aUnknowedPattern) {
        $aTmpPatern = array_diff($aUnknowedPattern, $aPatterns[1]);
        if (sizeof($aTmpPatern) == 5) {
          $aPatterns[6] = $aUnknowedPattern;
          unset($aUnknowedPatterns[implode('', $aPatterns[6])]);
          break;
        }
      }

      // si je fais une diff du patern incconu avec le 9 alors je sais que c'est un 5
      foreach ($aUnknowedPatterns as $aUnknowedPattern) {
        $aTmpPatern = array_diff($aUnknowedPattern, $aPatterns[9]);
        if (sizeof($aTmpPatern) == 0) {
          $aPatterns[5] = $aUnknowedPattern;
          unset($aUnknowedPatterns[implode('', $aPatterns[5])]);
        }
      }

      // m'en reste 2, qui on des tailles différentes le 0 et le 5
      foreach ($aUnknowedPatterns as $aUnknowedPattern) {
        if (sizeof($aUnknowedPattern) == 5) {
          $aPatterns[2] = $aUnknowedPattern;
          unset($aUnknowedPatterns[implode('', $aPatterns[2])]);
        } elseif (sizeof($aUnknowedPattern) == 6) {
          $aPatterns[0] = $aUnknowedPattern;
          unset($aUnknowedPatterns[implode('', $aPatterns[0])]);
        }
      }
      $aConvertion = [];
      foreach ($aPatterns as $iValue => $item) {
        asort($item);
        $aConvertion[implode('', $item)]  = $iValue;
      }

      //$aPatterns = array_flip($aPatterns);
      $aDigits = [];
      foreach ($aOutputValues as $sOutputValue) {
        $aOutputValue = str_split($sOutputValue);
        asort($aOutputValue);
        $sPattern = implode('', $aOutputValue);
        $aDigits[] = $aConvertion[$sPattern];
      }
      $iReturn += (int)implode('', $aDigits);
    }
    return $iReturn;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 26;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 61229;
  }
}