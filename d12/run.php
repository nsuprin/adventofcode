<?php


class D12 extends Day
{

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $oMap = new Map($aInput);
    return sizeof($oMap->findPaths());
  }

  /**
   * testa
   */
  public function testa() {
    $sTest = <<< TEST
start-A
start-b
A-c
A-b
b-d
A-end
b-end
TEST;
    $iReturn = $this->parse(explode("\n", $sTest));
    var_dump($iReturn);
    var_dump(10 == $iReturn ? 'OK' : 'KO');
  }
  /**
   * testa
   */
  public function test2a() {
    $sTest = <<< TEST
start-A
start-b
A-c
A-b
b-d
A-end
b-end
TEST;
    $iReturn = $this->parse2(explode("\n", $sTest));
    var_dump($iReturn);
    var_dump(36 == $iReturn ? 'OK' : 'KO');
  }

  /**
   * testb
   */
  public function testb() {
    $sTest = <<< TEST
dc-end
HN-start
start-kj
dc-start
dc-HN
LN-dc
HN-end
kj-sa
kj-HN
kj-dc
TEST;
    $iReturn = $this->parse(explode("\n", $sTest));
    var_dump($iReturn);
    var_dump(19 == $iReturn ? 'OK' : 'KO');
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $oMap = new Map($aInput);
    return sizeof($oMap->findPaths2());
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 226;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 3509;
  }
}

class Map {

  /**
   * Map constructor.
   * @param $aInput
   */
  public function __construct($aInput) {
    foreach ($aInput as $sLine) {
      $aCaves = explode('-', $sLine);
      foreach ($aCaves as $sCave) {
        $oCave = Cave::getInstance($sCave);
        $oCave->connectCave($aCaves);
      };
    }
  }

  /**
   * @param string $sCave
   * @return array
   */
  public function findPaths() {
    $oPath  = new Paths();
    $oPath->find();
    return $oPath->get();
  }

  /**
   * @param string $sCave
   * @return array
   */
  public function findPaths2() {
    $oPath  = new Paths();
    $oPath->find2();
    return $oPath->get();
  }
}

class Cave {
  /**
   * @var string
   */
  private $sCaveName = '';

  /**
   * @var array
   */
  private $aConnectedCaves  = [];

  /**
   * @var array
   */
  private static $aInstances  = [];

  /**
   * @param $sCave
   * @return Cave
   */
  public static function getInstance($sCave) {
    $sCave  = trim($sCave);
    if (!isset(self::$aInstances[$sCave])) {
      self::$aInstances[$sCave] = new self($sCave);
    }
    return self::$aInstances[$sCave];
  }

  /**
   * Cave constructor.
   * @param $sCave
   */
  private function __construct($sCaveName) {
    $this->sCaveName  = $sCaveName;
  }

  /**
   * @return string
   */
  public function getCaveName() {
    return $this->sCaveName;
  }

  /**
   * @param $aCaves
   */
  public function connectCave($aCaves) {
    foreach ($aCaves as $sCave) {
      if ($this->getCaveName() != $sCave) {
        $this->aConnectedCaves[$sCave]  = $sCave;
      }
    }
    asort($this->aConnectedCaves);
  }

  /**
   * @return array
   */
  public function getConnectedCaves() {
    return $this->aConnectedCaves;
  }

  /**
   * @return bool
   */
  public function isStart() {
    return 'start' == $this->getCaveName();
  }

  /**
   * @return bool
   */
  public function isEnd() {
    return 'end' == $this->getCaveName();
  }

  /**
   * @return bool
   */
  public function isBig() {
    return (bool)preg_match('/[A-Z]+/', $this->getCaveName());
  }

  /**
   * @return bool
   */
  public function isSmall() {
    return (
      !$this->isStart()
      && !$this->isEnd()
      && (bool)preg_match('/[a-z]+/', $this->getCaveName())
    );
  }

  public function __toString()
  {
    return $this->getCaveName();
  }
}

class Paths {

  /**
   * @var int
   */
  public $sNbVisiteSmallCaveMax = 2;

  /**
   * @var array
   */
  private $aPaths = [];

  /**
   * @var array
   */
  private $aVisitedCaves = [];

  /**
   * @param $sCave
   * @param array $aCaves
   */
  public function find($sCave = 'start', $aCaves = []) {
    $oCave = Cave::getInstance($sCave);
    if (!empty($aCaves) && $oCave->isStart()) {
      return;
    }
    if ($oCave->isSmall() && in_array($sCave, $aCaves)) {
      return;
    }
    $aCaves[] = $sCave;
    if ($oCave->isEnd()) {
      $this->aPaths[] = implode(',', $aCaves);
      return;
    }
    foreach ($oCave->getConnectedCaves() as $sConnectedCave) {
      $this->find($sConnectedCave, $aCaves);
    };
  }

  /**
   * @param $sCave
   * @param array $aCaves
   * @param array $aVisitedCaves
   */
  public function find2($sCave = 'start', $aCaves = [], $aVisitedCaves = []) {
    $oCave = Cave::getInstance($sCave);

    if (!empty($aCaves) && $oCave->isStart()) {
      return;
    }
    if ($oCave->isSmall()) {
      if (!isset($aVisitedCaves[$sCave])) {
        $aVisitedCaves[$sCave]  = 0;
      }
      if ($aVisitedCaves[$sCave] >= $this->sNbVisiteSmallCaveMax) {
        return;
      }
      $aVisitedCaves[$sCave]++;
      if (!in_array(array_sum($aVisitedCaves), [sizeof($aVisitedCaves), sizeof($aVisitedCaves) + 1])) {
        return;
      }
    }
    $aCaves[] = $sCave;
    if ($oCave->isEnd()) {
      $this->aPaths[] = $sPath = implode(',', $aCaves);
      return;
    }
    foreach ($oCave->getConnectedCaves() as $sConnectedCave) {
      $this->find2($sConnectedCave, $aCaves, $aVisitedCaves);
    };
  }

  /**
   * @return array
   */
  public function get() {
    return $this->aPaths;
  }

  public function __toString()
  {
    return implode("\n", $this->get());
  }
}