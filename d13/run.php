<?php


class D13 extends Day
{

  /**
   * @var array
   */
  private $aGrid  = [];

  private $aFolds = [];

  private $iMaxY  = 0;

  private $iMaxX  = 0;

  /**
   * @inheritDoc
   */
  public function parse($aInput) {
    $this->buildGrid($aInput);

    foreach ($this->aFolds as $aFold) {
      list($sType, $iValue) = array_values($aFold);
      $this->fold($sType, $iValue);
      break;
    }
    return $this->countGridDot();
  }

  private function countGridDot() {
    $iDots  = 0;
    foreach ($this->aGrid as $aLine) {
      $iDots  += count($aLine);
    }
    return $iDots;
  }

  private function fold($sType, $iValue) {
    if ('y' == $sType) {
      $this->foldY($iValue);
    } elseif ('x' == $sType) {
      $this->foldX($iValue);
    }
  }

  private function foldY($iValue) {
    $aGrid  = [];
    $iSubY  = $iValue;
    for($iY = 0 ; $iY <= $this->iMaxY ; $iY++) {
      if ($iY < $iValue) {
        if (!isset($this->aGrid[$iY])) {
          $this->aGrid[$iY] = [];
        }
        $aGrid[$iY] = $this->aGrid[$iY];
      } elseif ($iY > $iValue) {
        --$iSubY;
        if (isset($this->aGrid[$iY])) {
          $aGrid[$iSubY] = array_replace($aGrid[$iSubY], $this->aGrid[$iY]);
          ksort($aGrid[$iSubY]);
        }
      }
    }
    $this->iMaxY  = $iValue;
    $this->aGrid  = $aGrid;
  }

  private function foldX($iValue) {
    $aGrid  = [];
    foreach ($this->aGrid as $iY => $aY) {
      $iSubX  = $iValue;
      for ($iX = 0 ; $iX <= $this->iMaxX ; $iX++) {
        if ($iX < $iValue) {
          if (isset($this->aGrid[$iY][$iX])) {
            $aGrid[$iY][$iX]  = $this->aGrid[$iY][$iX];
          }
        } elseif ($iX > $iValue) {
          --$iSubX;
          if (isset($this->aGrid[$iY][$iX])) {
            $aGrid[$iY][$iSubX] = $this->aGrid[$iY][$iX];
          }
        }
        if (isset($aGrid[$iY]) && is_array($aGrid[$iY])) {
          ksort($aGrid[$iY]);
        }
      }
    }
    $this->iMaxX  = $iValue;
    $this->aGrid  = $aGrid;
  }

  /**
   * @param $aInput
   */
  private function buildGrid($aInput) {
    $aGrid  = [];
    foreach ($aInput as $sLine) {
      if (empty($sLine)) {
        continue;
      }
      if (preg_match('/(\d+),(\d+)/', $sLine, $aMatches)) {
        list(, $x, $y)  = $aMatches;
        $aGrid[$y][$x]  = 'x:'.$x.'y:'.$y;
        if ($x > $this->iMaxX) {
          $this->iMaxX  = $x;
        }
        if ($y > $this->iMaxY) {
          $this->iMaxY  = $y;
        }
      } elseif (preg_match('/fold along ([xy])=(\d+)/', $sLine, $aMatches)) {
        list(, $sType, $iValue) = $aMatches;
        $this->aFolds[] = ['type' => $sType, 'value' => $iValue];
      }
    }
    ksort($aGrid);
    foreach ($aGrid as $y => $aX) {
      ksort($aX);
      $this->aGrid[$y]  = $aX;
    }
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $this->buildGrid($aInput);

    foreach ($this->aFolds as $aFold) {
      list($sType, $iValue) = array_values($aFold);
      $this->fold($sType, $iValue);
    }
    $this->displayGrid();
  }

  private function displayGrid() {
    //var_dump([$this->iMaxY, $this->iMaxY]);exit();
    //var_dump($this->aGrid);exit();
    for ($y = 0 ; $y <= $this->iMaxY ; $y++) {
      for ($x = 0 ; $x <= $this->iMaxX ; $x++) {
        echo (isset($this->aGrid[$y][$x]) ? '#' : ' ');
      }
      echo "\n";
    }
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 17;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    // TODO: Implement getExpectedTest2() method.
  }
}