<?php


class D10 extends Day
{

  /**
   * @var string[]
   */
  private $aReferentialSyntax  = [
    ')' => '(',
    ']' => '[',
    '}' => '{',
    '>' => '<',
  ];

  /**
   * @var int[]
   */
  private $aReferentialPoint = [
    ')' => 3,
    ']' => 57,
    '}' => 1197,
    '>' => 25137,
  ];

  /***
   * @var int[]
   */
  private $aReferentialPoint2 = [
    ')' => 1,
    ']' => 2,
    '}' => 3,
    '>' => 4,
  ];

  /**
   * @var array
   */
  private $aIncompleteLines = [];

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $iReturn = 0;
    foreach ($aInput as $sInputLine) {
      if (empty($sInputLine)) {
        continue;
      }
      $sLine  = $sInputLine;
      $bReplace = true;
      $aPatterns = ['\{\}', '\(\)', '\[\]', '<>',];
      // gros nettoyage
      while ($bReplace) {
        $iCount = 0;
        $bReplace = false;
        foreach ($aPatterns as $sPattern) {
          $sLine = preg_replace("|$sPattern|", '', $sLine, -1, $iCount);
          if ($iCount > 0) {
            $bReplace = true;
          }
        }
      }
      $sReturn = $this->parseSyntax(str_split($sLine));
      if (isset($this->aReferentialPoint[$sReturn])) {
        $iReturn  += $this->aReferentialPoint[$sReturn];
      }
      if (empty($sReturn)) {
        $this->aIncompleteLines[$sInputLine] = $sLine;
      }
    }
    return $iReturn;
  }

  /**
   * @param $aLine
   * @return mixed
   */
  private function parseSyntax($aLine) {
    foreach ($aLine as $sCharacter) {
      if (in_array($sCharacter, $this->aReferentialSyntax)) {
        $sLastOpenCharacter = $sCharacter;
      } elseif (in_array($sCharacter, array_keys($this->aReferentialSyntax))) {
        $sOpenCharacter = $this->aReferentialSyntax[$sCharacter];
        if ($sOpenCharacter != $sLastOpenCharacter) {
          return $sCharacter;
        }
      }
    }
  }

  public function testa() {
    $this->parse(['(]']);
    $this->parse(['{()()()>']);
    $this->parse(['(((()))}']);
    $this->parse(['<([]){()}[{}])']);
    $this->parse([
      '{([(<{}[<>[]}>{[]{[(<()>',
      '[[<[([]))<([[{}[[()]]]',
      '[{[{({}]{}}([{[{{{}}([]',
      '[<(<(<(<{}))><([]([]()',
      '<{([([[(<>()){}]>(<<{{',
    ]);
  }

  public function test2a() {
    $this->parse2(['<{([{{}}[<[[[<>{}]]]>[]]']);
  }

  /**
   * @inheritDoc
   */
  public function parse2($aInput)
  {
    $this->parse($aInput);
    $aReferentiel = array_flip($this->aReferentialSyntax);
    $aScores  = [];
    foreach ($this->aIncompleteLines as $sLine) {
      $aLine = str_split($sLine);
      $aLine = array_reverse($aLine);
      $iScore = 0;
      $aDisplay = [];
      foreach ($aLine as $item) {
        $sChar = $aReferentiel[$item];
        $aDisplay[] = $sChar;
        $iScore *= 5;
        $iScore += $this->aReferentialPoint2[$sChar];
      }
      $aScores[implode('', $aDisplay)]  = $iScore;
    }
    asort($aScores);
    return array_values($aScores)[floor(sizeof($aScores) / 2)];
    var_dump($aScores);
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest()
  {
    return 26397;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    return 288957;
  }
}