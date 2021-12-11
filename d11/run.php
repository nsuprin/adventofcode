<?php


class D11 extends Day
{

  private $iSteps = 100;

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $oGrid  = new Grid($aInput);
    for ($i = 1 ; $i <= $this->iSteps ; $i++) {
      $oGrid->process();
    }
    return $oGrid->getFlashes();
  }

  /**
   * chuck testA
   */
  public function testa() {
    $this->iSteps = 3;
    $this->parse(explode("\n", <<< CONTENT
11111
19991
19191
19991
11111
CONTENT
));
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $oGrid  = new Grid($aInput);
    $iNbOctopus = $oGrid->getNbOctopus();
    $iStep = 0;
    do {
      $iStep++;
      $oGrid->process();
    } while ($oGrid->getNbFlashesStep() <> $iNbOctopus);
    return $iStep;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 1656;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 195;
  }
}

/**
 * Class Grid
 */
class Grid {

  /***
   * @var int
   */
  private $iFlashes = 0;

  /**
   * @var array
   */
  private $aGrid  = [];

  /**
   * @var array
   */
  private $aFlashStep = [];

  /**
   * Grid constructor.
   * @param $aInput
   */
  public function __construct($aInput) {
    foreach ($aInput as $sLine) {
      if (empty($sLine)) {
        continue;
      }
      $this->aGrid[]  = str_split($sLine);
    }
  }

  /**
   * @return int
   */
  public function getNbOctopus() {
    $iNb  = 0;
    foreach ($this->aGrid as $aLine) {
      $iNb  += sizeof($aLine);
    }
    return $iNb;
  }

  /**
   *
   */
  public function process() {
    $this->aFlashStep = [];
    $aMethods = [
      'increments',
      'flash',
      'reset',
    ];
    foreach ($aMethods as $sMethod) {
      $this->_run($sMethod);
    }
  }

  /**
   * @param $sMethod
   */
  private function _run($sMethod) {
    foreach ($this->aGrid as $y => $aLine) {
      foreach ($aLine as $x => $iPower) {
        call_user_func_array([$this, $sMethod], [$y, $x]);
      }
    }
  }

  /**
   * @return int
   */
  public function getFlashes() {
    return $this->iFlashes;
  }

  /**
   * @return int
   */
  public function getNbFlashesStep() {
    return sizeof($this->aFlashStep);
  }

  /**
   * @param $y
   * @param $x
   */
  private function reset($y, $x) {
    if ($this->aGrid[$y][$x] > 9) {
      $this->aGrid[$y][$x]  = 0;
    }
  }

  /**
   * @param $y
   * @param $x
   * @param bool $bFlash
   */
  private function increments($y, $x, $bFlash = false) {
    if (!isset($this->aGrid[$y][$x])) {
      return;
    }
    if ($this->aGrid[$y][$x] > 9) {
      return;
    }
    ++$this->aGrid[$y][$x];
    if ($bFlash) {
      $this->flash($y, $x);
    }
  }

  /***
   * @param $sourceY
   * @param $sourceX
   */
  private function flash($sourceY, $sourceX) {
    if ($this->aGrid[$sourceY][$sourceX] <= 9) {
      return;
    }
    $sPoint = "y:{$sourceY}x:{$sourceX}";
    if (isset($this->aFlashStep[$sPoint])) {
      return;
    }

    $this->iFlashes++;
    $this->aFlashStep[$sPoint] = $sPoint;
    for ($y = $sourceY - 1 ; $y <= $sourceY + 1 ; $y++) {
      for ($x = $sourceX - 1 ; $x <= $sourceX +  1 ; $x++) {
        if ($y == $sourceY && $x == $sourceX) {
          continue;
        }
        //echo "Flash $sourceY $sourceX Increments $y $x\n";
        $this->increments($y, $x, true);
      }
    }
  }

  /**
   * @return string
   */
  public function __toString()
  {
    $aReturn  = [];
    foreach ($this->aGrid as $aLine) {
      $aReturn[]  = implode("", $aLine);
    }
    return implode("\n", $aReturn);
  }
}