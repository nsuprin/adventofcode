<?php


class D03 extends Day
{

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $aCount = [];
    foreach ($aInput as $sLine) {
      for ($iPosition = 0 ; $iPosition < strlen($sLine) ; $iPosition++) {
        if (!isset($aCount[$iPosition])) {
          $aCount[$iPosition] = 0;
        }
        $aCount[$iPosition] += substr($sLine, $iPosition, 1);
      }
    }
    $iMean = sizeof($aInput) / 2;
    $aGamma = $aEpsilon = [];
    foreach ($aCount as $iPosition => $iCount) {
      $aGamma[$iPosition] = (int)($iCount > $iMean);
      $aEpsilon[$iPosition] = (int)(!$aGamma[$iPosition]);
    }
    $sGamma = implode($aGamma);
    $iGamma = bindec($sGamma);

    $sEpsilon = implode($aEpsilon);
    $iEpsilon = bindec($sEpsilon);
    return $iGamma * $iEpsilon;
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput, $iPosition = 0, $sMode = null)
  {
    if (sizeof($aInput) == 1) {
      return bindec($aInput[0]);
    }
    $aCount = [];
    foreach ($aInput as $sLine) {
      $sChar = substr($sLine, $iPosition, 1);
      if (!isset($aCount[$sChar])) {
        $aCount[$sChar] = [];
      }
      $aCount[$sChar][] = trim($sLine);
    }
    $aSize = [];
    foreach ($aCount as $sChar => $items) {
      $aSize[$sChar]  = sizeof($items);
    }
    asort($aSize);
    $aModeKeys = array_keys($aSize);
    $aBind  = [
      'o2' => 1,
      'co2' => 0,
    ];
    $aMode = [];
    if (1 == $aSize[0] && $aSize[0] == $aSize[1]) {
      $aMode[$sMode]  = $aCount[$aBind[$sMode]];
    } else {
      foreach ($aBind as $sBindMode => $iBindMode) {
        if (!isset($aModeKeys[$iBindMode])) {
          continue;
        }
        if (!isset($aCount[$aModeKeys[$iBindMode]])) {
          continue;
        }
        $aMode[$sBindMode] = $aCount[$aModeKeys[$iBindMode]];
      }
    }
    
    if (0 == $iPosition) {
      $aReturn = [];
      ++$iPosition;
      foreach ($aMode as $sSubMode => $aItems) {
        $aReturn[$sSubMode] = $this->parse2($aItems, $iPosition, $sSubMode);
      }
      list($o2, $co2) = array_values($aReturn);
      return  $o2 * $co2;
    } else {
      return $this->parse2($aMode[$sMode], ++$iPosition, $sMode);
    }
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 198;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 230;
  }
}