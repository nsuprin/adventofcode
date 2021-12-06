<?php
class D02 extends Day
{
  /**
   * @var int
   */
  private $ix = 0, $iY = 0, $iAim = 0;

  /**
   * @param $aInput
   * @return float|int
   */
  public function parse($aInput) {
    foreach ($aInput as $item) {
        list($sMovement, $iDelta) = explode(' ', $item);
        switch ($sMovement) {
            case 'forward':
                $this->ix += $iDelta;
                break;
            case 'down':
                $this->iY += $iDelta;
                break;
            case 'up':
                $this->iY -= $iDelta;
                break;
        }
    }
    $iReturn = $this->iY * $this->ix;
    return $iReturn;
  }

  /**
   * @param $aInput
   * @return float|int
   */
  public function parse2($aInput) {
      foreach ($aInput as $item) {
          list($sMovement, $iDelta) = explode(' ', $item);
          switch ($sMovement) {
              case 'forward':
                  $this->ix += $iDelta;
                  $this->iY += $iDelta * $this->iAim;
                  break;
              case 'down':
                  $this->iAim += $iDelta;
                  break;
              case 'up':
                  $this->iAim -= $iDelta;
                  break;
          }
      }
      $iReturn = $this->iY * $this->ix;
      return $iReturn;
  }

  /**
   * @return int
   */
  protected function getExpectedTest()
  {
    return 150;
  }

  /**
   * @return int
   */
  protected function getExpectedTest2()
  {
    return 900;
  }

}