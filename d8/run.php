<?php
class D8 {

  private static $sTest = <<< TEST
nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6
TEST;

  private static $sInput = <<< INPUT
acc -13
jmp +37
acc -19
jmp +1
jmp +1
jmp +413
acc +10
jmp +194
jmp +587
jmp +388
acc +48
nop +284
acc +35
jmp +239
acc +0
jmp +58
acc +22
acc +45
acc +25
acc +23
jmp +544
jmp +610
nop +273
jmp +554
jmp +584
acc +30
jmp +481
acc +29
jmp +342
acc +9
acc +23
nop +377
jmp +483
acc +33
jmp +128
nop +560
nop +437
jmp +485
acc +2
acc +30
jmp +456
acc +0
acc -15
nop +126
acc +47
jmp +299
acc +36
acc +9
jmp -21
acc +10
acc +26
acc -3
acc +31
jmp +337
nop +517
jmp +303
acc +20
nop -43
acc +30
acc +24
jmp +348
jmp +158
acc +23
acc +16
acc +40
jmp +1
jmp +465
acc +12
jmp +276
acc +0
acc +32
acc +43
jmp +487
acc +40
acc +49
nop +540
jmp +455
acc +24
jmp +481
acc +30
nop +256
acc +29
acc +14
jmp +390
jmp +1
acc -3
jmp +1
jmp +295
acc +6
acc +46
acc +16
nop +128
jmp -38
acc +0
acc +16
acc +10
jmp +185
acc -19
acc +0
acc +23
acc -16
jmp +180
acc +14
jmp +1
acc +31
acc -4
jmp +439
jmp +204
acc +50
acc +12
nop +154
jmp +474
acc -16
jmp +511
acc +6
acc +32
jmp +504
acc +17
acc +21
acc -18
jmp +298
acc -17
acc +16
acc +4
acc +18
jmp +18
acc -10
acc +26
acc +36
jmp +166
nop -109
jmp +266
acc -9
jmp +306
nop +324
acc +16
acc +33
acc +18
jmp -50
acc +25
jmp +196
acc +21
jmp +308
jmp +38
acc +27
jmp -48
acc +14
acc +46
acc +48
acc +15
jmp +223
acc +0
acc +12
jmp -115
acc +19
acc +27
acc +30
jmp +377
jmp -144
jmp +231
acc +1
jmp +410
acc +41
jmp +138
acc -13
acc -8
acc -7
acc +25
jmp +366
acc +8
jmp +182
acc +2
nop +104
acc +24
acc +21
jmp -43
acc -8
acc +37
acc +23
jmp +292
jmp +365
acc +33
nop -144
acc -10
jmp +387
acc +13
acc -6
acc -12
nop +134
jmp +345
acc +5
acc +16
acc +35
acc +50
jmp +250
acc +46
jmp +105
acc -6
nop -152
jmp +233
jmp -88
acc +39
jmp +59
acc -4
acc +47
jmp +165
acc +32
acc +49
acc +24
jmp +344
acc -5
acc +3
jmp +359
acc +27
jmp +72
acc +0
acc +16
acc +40
jmp +98
acc +2
acc +23
acc +48
acc +2
jmp -33
jmp -186
acc +27
nop -83
acc +2
acc +19
jmp -141
acc +39
acc +34
acc +33
jmp +282
jmp +306
acc +12
jmp +317
acc +32
acc +50
acc +17
jmp +52
acc +3
acc +35
jmp +328
acc +26
nop +163
acc +6
acc +19
jmp +154
acc +4
jmp +1
jmp +373
acc -12
acc +47
jmp +1
jmp -234
acc +45
acc +46
acc -14
acc +50
jmp -134
acc +26
jmp +128
jmp +233
acc +23
nop -133
jmp -154
jmp +260
acc +21
acc +14
nop -89
acc +9
jmp -113
acc +10
acc +5
jmp +127
acc -9
acc +2
jmp +286
nop +274
jmp +93
acc +46
acc +36
jmp +53
acc +30
jmp -126
acc +11
acc +11
acc +23
jmp +296
nop -100
jmp +304
jmp +219
acc +16
jmp -93
acc +12
jmp +1
jmp +205
acc +6
acc -11
jmp +202
jmp +107
jmp +1
jmp -224
acc +24
acc +50
acc +37
jmp +45
acc +25
acc -15
jmp -151
jmp +1
acc +47
jmp -196
jmp +1
jmp +300
jmp +116
acc +39
acc +0
nop -176
acc -7
jmp -53
acc +20
nop -216
nop +291
jmp +38
acc +0
acc +32
acc -19
jmp -28
jmp -176
acc +33
acc +11
acc +47
nop -58
jmp -203
acc +48
acc +50
acc +41
jmp -315
acc -12
acc +23
acc +32
jmp +210
acc +46
acc -11
acc -16
jmp +103
acc +25
nop +95
acc +9
jmp -117
nop +18
acc -19
acc +38
jmp -130
acc +22
jmp +25
nop +201
nop +205
acc +14
jmp -124
jmp -46
acc +9
jmp -257
acc -19
acc -17
acc +36
acc +24
jmp -210
jmp -231
acc +40
jmp +46
nop -192
acc -13
acc +7
acc +33
jmp +103
acc +18
acc +37
acc -14
jmp -11
acc +12
nop -240
acc +35
acc +33
jmp -274
acc -9
acc +24
jmp -128
nop -129
acc -17
jmp -62
acc +0
acc +42
nop +116
jmp -44
acc +16
jmp +179
acc -8
acc +8
jmp -149
acc +39
acc +2
acc +14
acc +12
jmp -373
jmp +76
jmp -232
jmp -385
acc +22
acc +41
acc +28
jmp -179
acc +0
acc +22
acc +15
jmp -291
acc -18
jmp -222
acc +45
acc -15
jmp +61
acc +10
acc +16
acc +43
jmp +177
acc +43
acc -12
acc +20
acc +27
jmp -13
acc -14
jmp -336
nop -158
acc +3
nop -409
acc +17
jmp -257
acc +0
nop +124
jmp +1
jmp +117
jmp -179
acc -17
acc -2
jmp +1
jmp -37
acc +42
jmp +175
acc -9
acc +12
acc +4
jmp +69
acc -7
jmp +1
acc +32
jmp +54
jmp -444
acc +7
jmp -87
acc -6
nop -323
acc +47
acc -5
jmp -143
jmp +1
nop -44
acc +27
acc +21
jmp -184
jmp -404
jmp -70
acc +32
jmp -13
acc +0
nop -452
acc +1
acc +31
jmp -77
jmp -401
acc +42
jmp -428
nop -120
acc -17
nop -75
acc +6
jmp +20
jmp -291
acc +7
jmp +37
acc +10
acc +15
jmp +1
acc +11
jmp -363
acc -14
nop -321
jmp -40
acc +41
acc +31
jmp +58
jmp -493
acc +32
acc -10
acc +44
jmp -211
acc +47
acc +23
jmp -241
jmp -224
acc -1
jmp -350
acc +8
jmp -280
acc -19
acc +0
acc +17
jmp -274
acc +27
acc +11
jmp -82
acc +48
acc +27
jmp -518
acc +3
jmp -124
jmp +1
jmp -490
acc +41
jmp -238
acc -6
jmp -386
jmp -189
acc -11
jmp +80
acc -8
acc +9
nop -99
jmp +56
acc -18
jmp -83
acc +28
acc +13
jmp -228
acc +32
acc +34
acc +3
jmp -272
nop -410
acc +13
acc -17
jmp -236
acc +45
acc +0
acc +19
nop +29
jmp +38
jmp -75
acc +7
acc +33
acc +40
jmp -180
jmp -557
acc +22
jmp -249
acc +44
acc +45
acc +2
acc -19
jmp -537
acc +44
acc +32
acc -14
acc +39
jmp -406
jmp -488
acc +14
acc +41
jmp -327
acc +17
acc +25
nop -573
acc +0
jmp -563
acc +18
nop -282
acc +13
acc +45
jmp -325
acc +41
acc -10
nop -47
nop -223
jmp -155
acc +14
acc +23
jmp +23
acc +21
nop -229
acc +27
acc -5
jmp -95
acc +2
acc -10
nop -451
jmp -393
jmp -406
acc +42
acc +18
acc +49
jmp -307
acc -11
jmp +1
jmp -424
jmp -192
acc +49
acc -1
acc -17
jmp -355
jmp -268
nop -320
acc +1
jmp -134
acc +46
jmp -564
acc +40
acc +29
acc +13
nop -285
jmp -272
acc +19
acc -14
acc +25
acc +18
jmp +1
INPUT;

  private static $bFull = false;

  /**
   * RUN
   */
  public static function run() {
    $aInput = explode("\n", self::$sInput);
    var_dump((self::parse($aInput)));
  }

  public static function test() {
    $aInput = explode("\n", self::$sTest);
    if (5 == (self::parse($aInput))) {
      var_dump('OK');
    } else {
      var_dump('KO');
    }
  }

  public static function test2() {
      $aInput = explode("\n", self::$sTest);
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

  public static function parse($aInput) {
      $iMaxLines    = sizeof($aInput) - 1;
      $iCurrentLine = 0;
      $bContinue = true;
      $iAccumulator = 0;
      $aProccessedLines = [];
      do {
          $sLine    = $aInput[$iCurrentLine];
          $aProccessedLines[$iCurrentLine]  = $sLine;
          list($operator, $value) = explode(' ', $sLine);
          //var_dump([$iCurrentLine, $operator, $value]);
          switch ($operator) {
              case 'acc' :
                  $iAccumulator += $value;
                  $iCurrentLine++;
                break;
              case 'jmp' :
                  $iCurrentLine += $value;
                  break;
              default:
                  $iCurrentLine++;
                  break;
          }
          if (isset($aProccessedLines[$iCurrentLine])) {
              $bContinue = false;
          }
          if ($iCurrentLine > $iMaxLines) {
              $bContinue = false;
              self::$bFull  = true;
          }
      } while ($bContinue);
      return $iAccumulator;
  }
  /**
   * @param $aInput
   * @return mixed
   */
  public static function parse2($aInput) {
      foreach ($aInput as $iLine => $sLine) {
          list($operator, $value) = explode(' ', $sLine);
          if (in_array($operator, ['jmp', 'nop'])) {
              switch ($operator) {
                  case 'jmp' :
                      $operator = 'nop';
                      break;
                  case 'nop':
                      $operator = 'jmp';
                      break;
              }
              $aSubInput = $aInput;
              $aSubInput[$iLine]    = implode(' ', [$operator, $value]);
              $iAccumulator = self::parse($aSubInput);
              if (self::$bFull) {
                  var_dump('yabon !');
                  break;
              }
          }
      }
      return $iAccumulator;
  }
}
