<?php
class D10 {

  private static $sTest = <<< TEST
28
33
18
42
31
14
46
20
48
47
24
23
49
45
19
38
39
11
1
32
25
35
8
17
7
9
4
2
34
10
3
TEST;

  private static $sInput = <<< INPUT
128
6
152
16
118
94
114
3
146
44
113
83
46
40
37
72
149
155
132
9
75
1
82
80
111
124
66
122
129
32
30
136
112
65
90
117
11
45
161
55
135
17
159
38
51
131
12
123
81
64
50
43
19
63
13
153
110
27
23
104
145
18
125
86
10
76
26
142
59
47
160
79
139
54
121
97
162
36
107
56
25
99
24
31
69
137
33
138
130
158
91
2
74
101
73
20
98
154
89
62
100
39
INPUT;

  private static $count = 0;

  /**
   * RUN
   */
  public static function run() {
    $aInput = explode("\n", self::$sInput);
    var_dump((self::parse($aInput)));
  }

  public static function test() {
    $aInput = explode("\n", self::$sTest);
    if (220 == (self::parse($aInput))) {
      var_dump('OK');
    } else {
      var_dump('KO');
    }
  }

  public static function test3() {
     /*
      exit();*/

      $aInput = explode("\n", self::$sTest);
      if (19208 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
  }

  public static function test2() {
      $aInput = explode("\n", <<< TEST
16
10
15
5
1
11
7
19
6
12
4
TEST
      );
      if (8 == (self::parse2($aInput))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
  }

  public static function run2() {
    $aInput = explode("\n", self::$sInput);
    var_dump(self::parse2($aInput));
  }

  public static function parse($aInput)
  {
      $iReturn = 0;
      $aInput[] = 0;
      asort($aInput);
      $aInput   = array_values($aInput);
      $aDiffs = [];
      for ($i = 0; $i < sizeof($aInput) -1; $i++) {
          $iDiff = $aInput[$i + 1] - $aInput[$i];
          if (!isset($aDiffs[$iDiff])) {
              $aDiffs[$iDiff] = 0;
          }
          $aDiffs[$iDiff]++;
      }
      $aDiffs[3]++;
      return $aDiffs[1] * $aDiffs[3] ;
  }

  /**
   * @param $aInput
   * @return mixed
   */
  public static function parse2($aInput) {
      $aInput[] = 0;
      asort($aInput);
      $aInput   = array_values($aInput);
      $aPossibilies  = [];
      $iPossibilities   = 1;
      $aInput[sizeof($aInput)]    = 3 + $aInput[sizeof($aInput) - 1];
      $aDiff    = [];
      for ($iPosition = 1; $iPosition < sizeof($aInput); $iPosition++) {
          $aDiff[] = $aInput[$iPosition] - $aInput[$iPosition - 1];
      }
      $sDiffs = implode('', $aDiff);

      $aPows    = [5 => 14, 4 => 7, 3 => 4, 2 => 2];
      $iCombinaisons    = 1;
      foreach ($aPows as $i => $iPow) {
          $sSearch = implode('', array_fill(0, $i, 1));
          $iCombinaisons *= pow($iPow, substr_count($sDiffs, $sSearch));
          $sDiffs   = str_replace($sSearch, '', $sDiffs);
      }

      return $iCombinaisons;

      $iReturn = 0;
      $aInput[] = 0;
      asort($aInput);
      $aInput   = array_values($aInput);
      $aPossibilies  = [];
      $iPossibilities   = 1;
      $aInput[sizeof($aInput)]    = 3 + $aInput[sizeof($aInput) - 1];
      for ($iPosition = 0; $iPosition < sizeof($aInput); $iPosition++) {
          $aPossibiliy= [];
          for ($iPossibility = 1 ; $iPossibility <= 3 ; $iPossibility += 1) {
              if (isset($aInput[$iPosition]) && in_array($aInput[$iPosition] + $iPossibility, $aInput)) {
                  $aPossibiliy[] = $aInput[$iPosition] + $iPossibility;
              }
          }
          if (sizeof($aPossibiliy) > 1) {
              $aPossibilies[$aInput[$iPosition]]    = $aPossibiliy;
              $iPossibilities   *= sizeof($aPossibiliy);
          }
      }

      $aPositions   = array_values($aPossibilies);
      $aIndexs   = array_keys($aPossibilies);
      var_dump($aPositions);;
      var_dump($aIndexs);
      exit();
      foreach ($aPositions as $iPosition => $iNexts) {

      }

      //var_dump($aPossibilies);
      var_dump($iPossibilities);
      var_dump($aPossibilies);
      self::render($aPossibilies);
      var_dump(self::$count);
      return self::$count;
      exit();

  }

  private static function render($aPossibilities, $iPossibiity = 0, $aRender = []) {
      $aRender[] = $iPossibiity;
      if (isset($aPossibilities[$iPossibiity])) {
          foreach ($aPossibilities[$iPossibiity] as $subPossibility) {
              self::render($aPossibilities, $subPossibility, $aRender);
          }
      } else {
          self::$count++;
          if (0 == self::$count % 1000000) {
              var_dump(self::$count);
          }
      }
  }
}
