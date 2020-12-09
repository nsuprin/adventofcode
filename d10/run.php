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

  public static function test2() {
      $aInput = explode("\n", self::$sTest);
      if (62 == (self::parse2($aInput, 127))) {
          var_dump('OK');
      } else {
          var_dump('KO');
      }
  }

  public static function run2() {
    $aInput = explode("\n", self::$sInput);
    var_dump(self::parse2($aInput, 258585477));
  }

  public static function parse($aInput)
  {
      $iReturn = 0;
      $aInput[] = 0;
      asort($aInput);
      $aInput   = array_values($aInput);
      $aDiffs = [];
      for ($i = 0; $i < sizeof($aInput) -1; $i++) {
          var_dump($i);
          $iDiff = $aInput[$i + 1] - $aInput[$i];
          if (!isset($aDiffs[$iDiff])) {
              $aDiffs[$iDiff] = 0;
          }
          $aDiffs[$iDiff]++;
      }
      $aDiffs[3]++;
      var_dump($aDiffs);
      return $aDiffs[1] * $aDiffs[3] ;
  }

  public static function check($aInput, $iCurrent) {
      $bValid   = false;
      $iValue   = $aInput[$iCurrent];
      $iMin = $iCurrent - self::$iPrevious;
      $iMax = $iCurrent - 1;

      //var_dump([$iValue, $iMin, $aInput[$iMin], $iMax, $aInput[$iMax]]);

      for ($i = $iMin ; $i <= $iMax ; $i++) {
          for ($j = $iMin ; $j <= $iMax ; $j++) {
              if ($i != $j && $iValue == $aInput[$i] + $aInput[$j]) {
                  $bValid   = true;
                  break 2;
              }
          }
      }
      return $bValid;
  }
  /**
   * @param $aInput
   * @return mixed
   */
  public static function parse2($aInput, $iValue) {
      $iReturn = 0;
      for ($i = 0 ; $i < sizeof($aInput) ; $i++) {
          $aValues  = [$aInput[$i]];
          for ($j = $i + 1 ; $j < sizeof($aInput) ; $j++) {
              $aValues[]    = $aInput[$j];
              $iSum = array_sum($aValues);
              if ($iSum > $iValue) {
                  break;
              }
              if ($iSum == $iValue) {
                  $iReturn = array_sum([min($aValues), max($aValues)]);
                  break 2;
              }
          }
      }
      return $iReturn;
  }
}
