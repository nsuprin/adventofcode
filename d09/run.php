<?php


class D09 extends Day
{
  /**
   * @var array
   */
  private $aHeightMap = [];

  /**
   * @var array
   */
  private $aLowPoints = [];

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $this->buildHeightMap($aInput);

    foreach ($this->aHeightMap as $y => $aLine) {
      foreach ($aLine as $x => $iHeight) {
        $aAdjacentHeight  = $this->getAdjacentHeights($y, $x);
        if ($this->pointIsLowest($aAdjacentHeight, $iHeight)) {
          $this->aLowPoints[] = $iHeight + 1;
        }
      }
    }
    return array_sum($this->aLowPoints);
  }

  /**
   * @param $aInput
   */
  private function buildHeightMap($aInput) {
    foreach ($aInput as $iLine => $sLine) {
      if (empty($sLine)) {
        continue;
      }
      $this->aHeightMap[] = str_split($sLine);
    }
  }

  /**
   * Return true if the given height is a lowest point
   */
  private function pointIsLowest($aAdjacentHeight, $iHeight) {
    $bLowest = true;
    foreach ($aAdjacentHeight as $iAdjacentHeight) {
      if ($iAdjacentHeight <= $iHeight) {
        $bLowest = false;
        break;
      }
    }
    return $bLowest;
  }

  /**
   * Explore adjacents heights of a given point
   * @param $y
   * @param $x
   * @return array
   */
  private function getAdjacentHeights($y, $x) {
    $aAdjacentHeight  = [];
    $this->getAdjacentHeight($aAdjacentHeight, $y, $x - 1);
    $this->getAdjacentHeight($aAdjacentHeight, $y - 1, $x);
    $this->getAdjacentHeight($aAdjacentHeight, $y + 1, $x);
    $this->getAdjacentHeight($aAdjacentHeight, $y, $x + 1);
    return $aAdjacentHeight;
  }

  /**
   * Build an adjacent point of a given point
   * @param $aAdjacentHeight
   * @param $y
   * @param $x
   */
  private function getAdjacentHeight(&$aAdjacentHeight, $y, $x) {
    $iHeight  = $this->getHeight($y, $x);
    if (!is_null($iHeight)) {
      $aAdjacentHeight[]  = $iHeight;
    }
  }

  /**
   * Return height of a given location
   * @param $y
   * @param $x
   * @return mixed|null
   */
  private function getHeight($y, $x) {
    $iReturn  = null;
    if (isset($this->aHeightMap[$y])) {
      if (isset($this->aHeightMap[$y][$x])) {
        $iReturn = $this->aHeightMap[$y][$x];
      }
    }
    return $iReturn;
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $this->buildHeightMap($aInput);

    $aSizeBassins  = [];

    foreach ($this->aHeightMap as $y => $aLine) {
      foreach ($aLine as $x => $iHeight) {
        $aAdjacentHeight  = $this->getAdjacentHeights($y, $x);
        if ($this->pointIsLowest($aAdjacentHeight, $iHeight)) {
          $oBassin = new Bassin($this->aHeightMap, $y, $x, $iHeight);
          $oBassin->build();
          $aSizeBassins[] = sizeof($oBassin->getBassin());
        }
      }
    }
    arsort($aSizeBassins);
    $aSizeBassins = array_values($aSizeBassins);
    $iSizeBassins = 1;
    for ($i = 0 ; $i < 3; $i++) {
      $iSizeBassins *= $aSizeBassins[$i];
    }
    return $iSizeBassins;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 15;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 1134;
  }
}

/**
 * Class Bassin
 */
class Bassin {

  /**
   * @var array
   */
  private $aHeightMap  = [];

  /**
   * @var array
   */
  private $aBassin = [];

  /**
   * @var
   */
  private $y, $x;

  public function __construct($aHeightMap, $y, $x, $iHeight)  {
    $this->aHeightMap = $aHeightMap;
    $this->addLocalisationInBasssin(new Localisation($y, $x, $iHeight));
  }

  /**
   * @param Localisation $oLocalisation
   */
  private function addLocalisationInBasssin(Localisation $oLocalisation) {
    $this->aBassin[(string)$oLocalisation]  = $oLocalisation;
  }

  /**
   * @param Localisation $oLocalisation
   * @return bool
   */
  private function isLocalicationInBassin(Localisation $oLocalisation) {
    return isset($this->aBassin[(string)$oLocalisation]);
  }

  /**
   * @param null $y
   * @param null $x
   * @return array
   */
  public function build($y = null, $x = null) {
    /**
     * @var Localisation $oLocalisation
     */
    if (is_null($y) && is_null($x)) {
      list($oLocalisation)  = array_values($this->aBassin);
      $y  = $oLocalisation->y;
      $x  = $oLocalisation->x;
    }
    $aAdjacentHeights = $this->getAdjacentHeights($y, $x);
    foreach ($aAdjacentHeights as $oLocalisation) {
      if (!$this->isLocalicationInBassin($oLocalisation)) {
        $this->addLocalisationInBasssin($oLocalisation);
        $this->build($oLocalisation->y, $oLocalisation->x);
      }
    }
    return $this->aBassin;
  }

  /**
   * @return array
   */
  public function getBassin() {
    return $this->aBassin;
  }

  /**
   * Explore adjacents heights of a given point
   * @param $y
   * @param $x
   * @return array
   */
  private function getAdjacentHeights($y, $x) {
    $aAdjacentHeight  = [];
    $this->getAdjacentHeight($aAdjacentHeight, $y, $x - 1);
    $this->getAdjacentHeight($aAdjacentHeight, $y - 1, $x);
    $this->getAdjacentHeight($aAdjacentHeight, $y + 1, $x);
    $this->getAdjacentHeight($aAdjacentHeight, $y, $x + 1);
    return $aAdjacentHeight;
  }

  /**
   * Build an adjacent point of a given point
   * @param $aAdjacentHeight
   * @param $y
   * @param $x
   */
  private function getAdjacentHeight(&$aAdjacentHeight, $y, $x) {
    $iHeight  = $this->getHeight($y, $x);
    if (!is_null($iHeight)) {
      $aAdjacentHeight[]  = new Localisation($y, $x, $iHeight);
    }
  }

  /**
   * Return height of a given location
   * @param $y
   * @param $x
   * @return mixed|null
   */
  private function getHeight($y, $x) {
    $iReturn  = null;
    if (isset($this->aHeightMap[$y])) {
      if (isset($this->aHeightMap[$y][$x])) {
        if (9 != $this->aHeightMap[$y][$x]) {
          $iReturn = $this->aHeightMap[$y][$x];
        }
      }
    }
    return $iReturn;
  }
}

/**
 * Class Localisation
 */
class Localisation {
  /**
   * @var int|mixed
   */
  public $y = 0, $x = 0, $iHeight = 0;

  /**
   * Localisation constructor.
   * @param int $y
   * @param int $x
   * @param int $iHeight
   */
  public function __construct($y = 0, $x = 0, $iHeight = 0) {
    $this->y  = $y;
    $this->x  = $x;
    $this->iHeight  = $iHeight;
  }

  /**
   * @return string
   */
  public function __toString() {
    return 'y:'.$this->y.'x:'.$this->x;
  }
}