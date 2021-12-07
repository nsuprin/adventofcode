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
    asort($aCrabs);
    $aConsos = [];
    $aConsos = [];
    foreach ($aCrabs as $i => $aCrab) {
      $aConsos[$i] = $this->getFuelConso($aCrabs, $i);
    }
    asort($aConsos);
    return array_values($aConsos)[0];
  }

  /**
   * @param $aCrabs
   * @param $iMeanCrab
   * @return float|int
   */
  private function getFuelConso($aCrabs, $iMeanCrab) {
    $iFuel  = 0;
    foreach ($aCrabs as $iCrab) {
      $iFuelCrab = abs($iMeanCrab - $iCrab);
      //echo "$iCrab to $iMeanCrab : $iFuelCrab\n";
      $iFuel += $iFuelCrab;
    }
    return $iFuel;
  }

  /**
   * @param $aCrabs
   * @param $iMeanCrab
   * @return float|int
   */
  private function getFuelConso2($aCrabs, $iMeanCrab) {
    $iFuel  = 0;
    foreach ($aCrabs as $iCrab) {
      $iFuelCrab = abs($iMeanCrab - $iCrab);

      //echo "$iCrab to $iMeanCrab : $iFuelCrab\n";
      $iFuel += $this->getFuelMax($iFuelCrab);
    }

    return $iFuel;
  }

  /**
   * @param $iFuel
   */
  private function getFuelMax($iFuel)
  {
    if (!isset($this->aFuelMax[$iFuel])) {
      $this->aFuelMax[$iFuel] = 0;
      for ($i = 1; $i <= $iFuel; $i++) {
        $this->aFuelMax[$iFuel] += $i;
      }
    }
    return $this->aFuelMax[$iFuel];
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    list($sCrabs)  = $aInput;
    $aCrabs  = explode(',', $sCrabs);
    asort($aCrabs);
    $aConsos = [];
    foreach ($aCrabs as $i => $aCrab) {
      $aConsos[$i] = $this->getFuelConso2($aCrabs, $i);
    }
    asort($aConsos);
    return array_values($aConsos)[0];
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