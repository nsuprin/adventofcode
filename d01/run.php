<?php
class D01 extends Day
{
  /**
   * @param $aInput
   * @return float|int
   */
  public function parse($aInput) {
    $iReturn = 0;
    for ($i = 1 ; $i < sizeof($aInput) ; $i++) {
        if ($aInput[$i] > $aInput[$i - 1]) {
            $iReturn++;
        }
    }
    return $iReturn;
  }

  /**
   * @param $aInput
   * @return float|int
   */
  public function parse2($aInput) {
    $aTmp = [];
    for ($i = 0 ; $i < sizeof($aInput) - 2 ; $i++) {
        $aTmp[$i] = $aInput[$i] + $aInput[$i + 1] + $aInput[$i + 2];
    }
    return $this->parse($aTmp);
  }

  /**
   * @return int
   */
  protected function getExpectedTest() {
    return 7;
  }

  /**
   * @return int
   */
  protected function getExpectedTest2() {
    return 5;
  }
}

