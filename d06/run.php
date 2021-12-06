<?php


class D06 extends Day
{
  /*
   *
   */
  private $iNbDays  = 80;

  private $aFishs = [];

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $aTmpFishs  = explode(',', $aInput[0]);
    foreach ($aTmpFishs as $iFishPhase) {
      $this->addFish($this->aFishs, $iFishPhase, 1);
    }
    for ($iDay = 1 ; $iDay <= $this->iNbDays ; $iDay++) {
      $aNewFish = [];
      foreach ($this->aFishs as $iFishPhase => $iNb) {
        if (0 == $iFishPhase) {
          $this->addFish($aNewFish, 6, $iNb);
          $this->addFish($aNewFish, 8, $iNb);
          continue;
        }
        $this->addFish($aNewFish, $iFishPhase - 1, $iNb);
      }
      $this->aFishs = $aNewFish;
    }
    return array_sum($this->aFishs);
  }

  /**
   * @param $iFishPhase
   * @param $iNbFishes
   */
  private function addFish(&$aFish, $iFishPhase, $iNbFishes) {
    if (!isset($aFish[$iFishPhase])) {
      $aFish[$iFishPhase]  = 0;
    }
    $aFish[$iFishPhase]  += $iNbFishes;
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $this->iNbDays  = 256;
    return $this->parse($aInput);
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 5934;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 26984457539;
  }
}