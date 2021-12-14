<?php


class D14 extends Day
{

  /**
   * @var array
   */
  private $aPairs = [];

  /**
   * @var array
   */
  private $aTemplate = [];

  /**
   * @var int
   */
  private $iSteps = 10;

  /**
   * @var array
   */
  private $aCount = [];

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $this->build($aInput);
    $aCounts  = [];
    echo 'Template : '.implode('', $this->aTemplate)."\n";
    for ($i = 1 ; $i <= $this->iSteps ; $i++) {
      $this->polymerization($this->aTemplate);
      //echo "Step $i ".implode('', $this->aTemplate)."\n";
      asort($this->aCount);
      $aCounts[]  =  $this->aCount;
      var_dump($this->aCount);
    }
    foreach ($aCounts as $iLine => $aCount) {
      if (0 == $iLine) {
        echo implode(";", array_keys($aCount))."\n";
      }
      echo implode(";", array_values($aCount))."\n";
    }
    $iMin = array_shift($this->aCount);
    $iMax = array_pop($this->aCount);
    return $iMax - $iMin;
  }

  /**
   * @param $aTemplate
   */
  private function polymerization($aTemplate) {
    $this->aCount = [];
    $aOut = [];
    foreach ($aTemplate as $iPos => $sPair) {
      $aOut[] = $sPair;
      $this->addCount($sPair);
      if (isset($aTemplate[$iPos + 1])) {
        $sSubPair = $sPair . $aTemplate[$iPos + 1];
        if (isset($this->aPairs[$sSubPair])) {
          $aOut[] = $this->aPairs[$sSubPair];
          $this->addCount($this->aPairs[$sSubPair]);
        }
      }
    }
    $this->aTemplate  = $aOut;
  }

  private function addCount($sPair) {
    if (!isset($this->aCount[$sPair])) {
      $this->aCount[$sPair] = 0;
    }
    $this->aCount[$sPair]++;
  }

  /**
   * @param $aInput
   */
  private function build($aInput) {
    $this->aTemplate = str_split(array_shift($aInput));
    foreach ($aInput as $sLine) {
      if (empty($sLine)) {
        continue;
      }
      list($sRule, $sElement)  = explode(' -> ', $sLine);
      $this->aPairs[$sRule] = $sElement;
    }
  }

  public function test2()
  {
    $this->iSteps = 14;
    parent::test2();
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    return $this->parse($aInput);
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 1588;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 2188189693529;
  }
}