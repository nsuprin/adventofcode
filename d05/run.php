<?php


class D05 extends Day
{
  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $aGrid = [];
    $iOverlap = 0;
    foreach ($aInput as $sLine) {
      $oSegment = new Segment($aGrid, $sLine);
      $iOverlap += $oSegment->draw();
    }
    return $iOverlap;
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $aGrid = [];
    $iOverlap = 0;
    foreach ($aInput as $sLine) {
      $oSegment = new Segment2($aGrid, $sLine);
      $iOverlap += $oSegment->draw();
    }
    return $iOverlap;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 5;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 12;
  }

}

/**
 * Class Segment
 */
class Segment {

  const BEGIN = 0;
  const END = 1;
  const X = 0;
  const Y = 1;

  /**
   * @var int
   */
  protected $iOverlap = 0;

  /**
   * @var array
   */
  protected $aPoints = [];

  /**
   * @var array
   */
  protected $aGrille = [];

  /**
   * Segment constructor.
   * @param $sLine
   */
  public function __construct(&$aGrille, $sLine) {
    $this->aGrille  = &$aGrille;
    foreach (explode(' -> ', $sLine) as $iPoint => $aPoint) {
      $this->aPoints[$iPoint] = explode(',', $aPoint);
    }
  }

  /**
   * @return int
   */
  public function draw() {
    if ($this->getBeginX() == $this->getEndX()) {
      $this->drawSegmentY();
    } elseif ($this->getBeginY() == $this->getEndY()) {
      $this->drawSegmentX();
    }
    return $this->iOverlap;
  }

  /**
   *
   */
  protected function drawSegmentY() {
    $iDelta = ($this->getBeginY() < $this->getEndY()) ? 1 : -1;
    for ($y = $this->getBeginY() ; $y != $this->getEndY() + $iDelta ; $y += $iDelta) {
      $this->drawPoint($this->getBeginX(), $y);
    }
  }

  /**
   *
   */
  protected function drawSegmentX() {
    $iDelta = ($this->getBeginX() < $this->getEndX()) ? 1 : -1;
    for ($x = $this->getBeginX() ; $x != $this->getEndX() + $iDelta ; $x += $iDelta) {
      $this->drawPoint($x, $this->getBeginY());
    }
  }

  /**
   * @param $x
   * @param $y
   */
  protected function drawPoint($x, $y) {
    if (!isset($this->aGrille[$y])) {
      $this->aGrille[$y] = [];
    }
    if (!isset($this->aGrille[$y][$x])) {
      $this->aGrille[$y][$x]  = 0;
    } elseif (1 == $this->aGrille[$y][$x]) {
      $this->iOverlap++;
    }
    $this->aGrille[$y][$x]++;
  }

  /**
   * @return mixed
   */
  protected function getBegin() {
    return $this->aPoints[self::BEGIN];
  }

  /**
   * @return mixed
   */
  protected function getEnd() {
    return $this->aPoints[self::END];
  }

  /**
   * @return mixed
   */
  protected function getBeginX() {
    return $this->getBegin()[self::X];
  }

  /**
   * @return mixed
   */
  protected function getBeginY() {
    return $this->getBegin()[self::Y];
  }

  /**
   * @return mixed
   */
  protected function getEndX() {
    return $this->getEnd()[self::X];
  }

  /**
   * @return mixed
   */
  protected function getEndY() {
    return $this->getEnd()[self::Y];
  }
}
/**
 * Class Segment2
 */
class Segment2 extends Segment {

  /**
   * @return int
   */
  public function draw() {
    parent::draw();
    // diagonal xy
    if (abs($this->getBeginX() - $this->getEndX()) == abs($this->getBeginY() - $this->getEndY())) {
      $this->drawSegmentXY();
    }
    return $this->iOverlap;
  }

  /**
   *
   */
  private function drawSegmentXY() {
    $iDeltaX = ($this->getBeginX() < $this->getEndX()) ? 1 : -1;
    $iDeltaY = ($this->getBeginY() < $this->getEndY()) ? 1 : -1;
    $y = $this->getBeginY();
    for ($x = $this->getBeginX() ; $x != $this->getEndX() + $iDeltaX ; $x += $iDeltaX) {
      $this->drawPoint($x, $y);
      $y = $y + $iDeltaY;
    }
  }
}