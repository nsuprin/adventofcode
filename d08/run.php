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
      var_dump($aOutputValues);
      foreach ($aOutputValues as $sOutputvalue) {
        $iDigit = $this->bind(strlen($sOutputvalue));
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
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    // TODO: Implement parse2() method.
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
    // TODO: Implement getExpectedTest2() method.
  }
}