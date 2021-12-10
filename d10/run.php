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

  /**
   * @inheritDoc
   */
  public function parse($aInput)
  {
    $iReturn = 0;
    foreach ($aInput as $sLine) {
      if (empty($sLine)) {
        continue;
      }
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
    }
    return $iReturn;
  }

  /**
   * @param $aLine
   * @return mixed
   */
  private function parseSyntax($aLine) {
    $aCharacters  = [
      '(' => 0,
      '[' => 0,
      '{' => 0,
      '<' => 0,
    ];
    foreach ($aLine as $sCharacter) {
      if (in_array($sCharacter, $this->aReferentialSyntax)) {
        $aCharacters[$sCharacter]++;
        $sLastOpenCharacter = $sCharacter;
      } elseif (in_array($sCharacter, array_keys($this->aReferentialSyntax))) {
        $sOpenCharacter = $this->aReferentialSyntax[$sCharacter];
        if ($sOpenCharacter != $sLastOpenCharacter) {

          echo 'Expected '.$sLastOpenCharacter.', found : '.$sCharacter."\n";
          return $sCharacter;
        }
        //var_dump($sOpenCharacter.' '.$sCharacter);
        $aCharacters[$sOpenCharacter]--;
        if ($aCharacters[$sOpenCharacter] < 0) {
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
    return 26397;
  }

  /**
   * @inheritDoc
   */
  protected function getExpectedTest2()
  {
    // TODO: Implement getExpectedTest2() method.
  }
}