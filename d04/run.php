<?php


class D04 extends Day
{

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $aTirage  = $this->getTirages($aInput);
    $oGrilleCollection  = $this->getGrilleCollection($aInput);

    // --- TAS
    foreach ($aTirage as $iTirage) {
      $iResult = $oGrilleCollection->findNumber($iTirage);
      if (!empty($iResult)) {
        return $iResult;
      }
    }
  }

  /**
   * @param $aInput
   */
  private function getTirages(&$aInput) {
    // --- get tirages
    $aTirage = explode(',', array_shift($aInput));
    array_shift($aInput);
    return $aTirage;
  }

  /**
   * @param $aInput
   * @return GrilleCollection
   */
  private function  getGrilleCollection(&$aInput) {
    // --- init grilles
    $oGrilleCollection  = new GrilleCollection();
    $aGrille  = [];
    for ($iLine = 0 ; $iLine < sizeof($aInput) ; $iLine++) {
      $sLine  = $aInput[$iLine];
      if (empty($sLine)) {
        $oGrilleCollection->addGrille($aGrille);
        $aGrille  = [];
      } else {
        $aLine = str_split($sLine, 3);
        array_walk($aLine, [$this, 'array_trim']);
        $aGrille[] = $aLine;
      }
    }
    $oGrilleCollection->addGrille($aGrille);
    return $oGrilleCollection;
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $aTirage  = $this->getTirages($aInput);
    $oGrilleCollection  = $this->getGrilleCollection($aInput);

    // --- TAS
    foreach ($aTirage as $iTirage) {
      $iResult = $oGrilleCollection->findNumber2($iTirage);
      if (!empty($iResult)) {
        return $iResult;
      }
    }
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 4512;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 1924;
  }
}

/**
 * Class Grille
 */
class Grille {
  /**
   * @var array
   */
  private $aGrille  = [];

  /**
   * @var array
   */
  private $aFoundGrille =  [];

  /**
   * @var array
   */
  private $aFoundX  = [], $aFoundY = [];

  /**
   * Grille constructor.
   * @param $aGrille
   */
  public function __construct($aGrille)  {
    $this->aGrille = $aGrille;
  }

  /**
   * @param $iNumber
   */
  public function findNumber($iNumber) {
    $iSize = 5;
    $aResult = explode(',', rtrim(
      $this->recursive_array_search(
        $iNumber,
        $this->aGrille
      ), ',')
    );
    if (!is_array($aResult) || sizeof($aResult) != 2) {
      return;
    }
    list($y, $x)  = $aResult;
    $this->aFoundGrille[$y][$x] = $iNumber;
    unset($this->aGrille[$y][$x]);

    if (!isset($this->aFoundY[$y])) {
      $this->aFoundY[$y]  = 0;
    }
    $this->aFoundY[$y]++;

    if (!isset($this->aFoundX[$x])) {
      $this->aFoundX[$x]  = 0;
    }
    $this->aFoundX[$x]++;

    if ($this->aFoundY[$y] >= $iSize|| $this->aFoundX[$x] >= $iSize) {
      $iResult = 0;
      foreach ($this->aGrille as $aLine) {
        $iResult  +=array_sum($aLine);
      }
      return $iResult * $iNumber;
    }

  }

  /**
   * @param $needle
   * @param $haystack
   * @param string $currentKey
   * @return false|string
   */
  private function recursive_array_search($needle, $haystack, $currentKey = '') {
    foreach($haystack as $key=>$value) {
      if (is_array($value)) {
        $nextKey = $this->recursive_array_search($needle,$value, $currentKey . '' . $key . ',');
        if ($nextKey) {
          return $nextKey;
        }
      }
      else if($value==$needle) {
        return is_numeric($key) ? $currentKey . '' .$key . ',' : $currentKey . '' .$key . ',';
      }
    }
    return false;
  }
}

/**
 * Class GrilleCollection
 */
class GrilleCollection {

  private static $aWinGrille = [];

  /**
   * @var array
   */
  private $aGrilleCollection = [];

  /**
   * GrilleCollection constructor.
   */
  public function __construct() {

  }

  public function addGrille($aGrille) {
    $this->aGrilleCollection[]  = new Grille($aGrille);
  }

  public function findNumber($iNumber) {
    /**
     * @var $oGrille Grille
     */
    foreach ($this->aGrilleCollection as $iGrille => $oGrille) {
      $iReturn = $oGrille->findNumber($iNumber);
      if (!empty($iReturn)) {
        return $iReturn;
      }
    }
  }

  public function findNumber2($iNumber) {
    /**
     * @var $oGrille Grille
     */
    foreach ($this->aGrilleCollection as $iGrille => $oGrille) {
      $iTmp = $oGrille->findNumber($iNumber);
      if (!empty($iTmp)) {
        self::$aWinGrille[$iGrille] = $iTmp;
        if (sizeof(self::$aWinGrille) == sizeof($this->aGrilleCollection)) {
          return $iTmp;
        }
      }
    }
  }
}