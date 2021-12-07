<?php


class D07 extends Day
{
  /**
   * @var array
   */
  private $aFuelMax = [];

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    list($sCrabs)  = $aInput;
    $aCrabs  = explode(',', $sCrabs);
    $aConsos = [];
    foreach ($aCrabs as $i => $aCrab) {
      $aConsos[] = $this->getFuelConso($aCrabs, $i);
    }
    asort($aConsos);
    return array_values($aConsos)[0];
  }

  /**
   * @param $aCrabs
   * @param $i
   * @return float|int
   */
  private function getFuelConso($aCrabs, $i) {
    $iFuel  = 0;
    foreach ($aCrabs as $iCrab) {
      $iFuel += abs($i - $iCrab);
    }
    return $iFuel;
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    list($sCrabs)  = $aInput;
    $aCrabs  = explode(',', $sCrabs);
    $aConsos = [];
    foreach ($aCrabs as $i => $aCrab) {
      $aConsos[] = $this->getFuelConso2($aCrabs, $i);
    }
    asort($aConsos);
    return array_values($aConsos)[0];
  }

  /**
   * @param $aCrabs
   * @param $iMeanCrab
   * @return float|int
   */
  private function getFuelConso2($aCrabs, $i) {
    $iFuel  = 0;
    foreach ($aCrabs as $iCrab) {
      $iFuel += $this->getFuelMax(abs($i - $iCrab));
    }
    return $iFuel;
  }

  /**
   * @param $iFuel
   * @return float|int|mixed
   */
  private function getFuelMax($iFuel) {
    if (!isset($this->aFuelMax[$iFuel])) {
      $this->aFuelMax[$iFuel] = array_sum(range(1, $iFuel));
    }
    return $this->aFuelMax[$iFuel];
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 37;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 168;
  }
}