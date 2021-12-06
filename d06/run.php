<?php


class D06 extends Day
{
  /*
   *
   */
  private $iNbDays  = 80;

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $aFishs  = explode(',', $aInput[0]);
    for ($iDay = 1 ; $iDay <= $this->iNbDays ; $iDay++) {
      $iFishSize = sizeof($aFishs);
      for ($iFish = 0 ; $iFish <  $iFishSize; $iFish++) {
        if (0 == $aFishs[$iFish]--) {
          $aFishs[$iFish] = 6;
          array_push($aFishs, 8);
        }
      }
      //echo "After $iDay days : ".implode(',', $aFishs)."\n";
    }
    return sizeof($aFishs);
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $this->iNbDays  = 256;
    $this->parse($aInput);
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