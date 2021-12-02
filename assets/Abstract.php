<?php


abstract class Day {
  /**
   * @var array
   */
  protected $aInput = [], $aTest = [];

  /**
   * Day constructor.
   */
  public function __construct() {
    $this->aInput = explode("\n", $this->getInputData());
    $this->aTest = explode("\n", $this->getTestData());
  }

  /**
   * RUN
   */
  public function run() {
    var_dump($this->parse($this->aInput));
  }

  /**
   *
   */
  public function run2() {
    var_dump($this->parse2($this->aInput));
  }


  /**
   * TEST
   */
  public function test() {
    $iResult = $this->parse($this->aTest);
    if ($this->getExpectedTest() == $iResult) {
      var_dump('OK');
    } else {
      var_dump('KO');
    }
  }

  /**
   * TEST
   */
  public function test2() {
    $iResult = $this->parse2($this->aTest);
    if ($this->getExpectedTest2() == $iResult) {
      var_dump('OK');
    } else {
      var_dump('KO');
    }
  }

  /**
   * @param $aInput
   * @return mixed
   */
  abstract public function parse($aInput);

  /**
   * @param $aInput
   * @return mixed
   */
  abstract public function parse2($aInput);

  /**
   * @return mixed
   */
  abstract protected function getTestData();
  /**
   * @return mixed
   */
  abstract protected function getExpectedTest();

  /**
   * @return mixed
   */
  abstract protected function getExpectedTest2();
  
  /**
   * @return mixed
   */
  abstract protected function getInputData();

}