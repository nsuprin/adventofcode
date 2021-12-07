<?php


class D07 extends Day
{

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    list($sCrabs)  = $aInput;
    $aCrabs  = explode(',', $sCrabs);
    asort($aCrabs);
    $iMeanCrab  = floor($this->getMedian($aCrabs));
    $aConsos = [];
    for ($i = 0 ; $i < sizeof($aCrabs) / 2 ; $i++) {
      //$aConsos[$iMeanCrab + $i] = $this->getFuelConso($aCrabs, $iMeanCrab + $i);
      $aConsos[$iMeanCrab + $i * -1] = $this->getFuelConso($aCrabs, $iMeanCrab + $i * -1);
    }
    asort($aConsos);
    return array_values($aConsos)[0];
  }

  /**
   * @param $aCrabs
   * @param $iMeanCrab
   * @return float|int
   */
  private function getFuelConso($aCrabs, $iMeanCrab) {
    $iFuel  = 0;
    foreach ($aCrabs as $iCrab) {
      $iFuelCrab = abs($iMeanCrab - $iCrab);
      //echo "$iCrab to $iMeanCrab : $iFuelCrab\n";
      $iFuel += $iFuelCrab;
    }
    return $iFuel;
  }

  /**
   * A PHP function that will calculate the median value
   * of an array
   *
   * @param array $arr The array that you want to get the median value of.
   * @return boolean|float|int
   * @throws Exception If it's not an array
   */
  private function getMedian($arr) {
    //Make sure it's an array.
    if(!is_array($arr)){
      throw new Exception('$arr must be an array!');
    }
    //If it's an empty array, return FALSE.
    if(empty($arr)){
      return false;
    }
    //Count how many elements are in the array.
    $num = count($arr);
    //Determine the middle value of the array.
    $middleVal = floor(($num - 1) / 2);
    //If the size of the array is an odd number,
    //then the middle value is the median.
    if($num % 2) {
      return $arr[$middleVal];
    }
    //If the size of the array is an even number, then we
    //have to get the two middle values and get their
    //average
    else {
      //The $middleVal var will be the low
      //end of the middle
      $lowMid = $arr[$middleVal];
      $highMid = $arr[$middleVal + 1];
      //Return the average of the low and high.
      return (($lowMid + $highMid) / 2);
    }
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    // TODO: Implement parse2() method.
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 37;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    // TODO: Implement getExpectedTest2() method.
  }
}