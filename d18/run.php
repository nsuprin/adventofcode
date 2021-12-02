<?php

class D18
{

    /**
     * RUN
     */
    public static function run()
    {
        $aInput = explode("\n", self::$sInput);
        var_dump((self::parse($aInput)));
    }


    /**
     * TEST
     */
    public static function test()
    {
        $aInput = explode("\n", <<< TEST
1 + 2 * 3 + 4 * 5 + 6
TEST
        );
        if (71 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }

        $aInput = explode("\n", <<< TEST
1 + (2 * 3) + (4 * (5 + 6))
TEST
        );
        if (51 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }

        $aInput = explode("\n", <<< TEST
2 * 3 + (4 * 5)
TEST
        );
        if (26 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }

        $aInput = explode("\n", <<< TEST
5 + (8 * 3 + 9 + 3 * 4 * 3)
TEST
        );
        if (437 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }

        $aInput = explode("\n", <<< TEST
((2 + 4 * 9) * (6 + 9 * 8 + 6) + 6) + 2 + 4 * 2
TEST
        );
        if (13632 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
    }

    public static function run2()
    {
        $aInput = explode("\n", self::$sInput);
        var_dump(self::parse2($aInput));
    }

    public static function test2()
    {
        $aInput = explode("\n", self::$sTest);
        if (848 == (self::parse2($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
    }

    /**
     * @param $aInput
     */
    public static function parse($aInput)
    {
        $aResults   = [];
        foreach ($aInput as $sLine) {
            $oCalc  = new Calculator($sLine);
            $aResults[] = $oCalc->run();
        }
        return array_sum($aResults);
    }

    /**
     * @param $aInput
     * @return mixed
     */
    public static function parse2($aInput)
    {

    }

    private static $sInput = <<< INPUT
(3 + 8 * 9 * (4 * 6 + 3 + 4)) * 9 + 9 * 7 * ((9 * 7) + 4)
(9 + (9 * 3 + 2 * 2 + 6 * 2) + 7 + 9) + 5
8 * 7 * (3 + (2 * 5 + 8)) + 6 + 8 + 6
(4 * 6 + 7 + 7 * 4 + 7) * (5 + 6 * 6 * 6 * 8) * 8 * (5 * 4 * 9 + 4 + 3 * 9) * 3
(8 + 8 * 2) * 9 * 5 + (2 + 2 + 3 * 7 * 5 + 6) + 5
(4 * (2 + 4) + 3 + (7 * 5 * 6 * 5 + 2 + 9)) + 8 * ((6 * 6 + 2 + 7 + 2) * (4 * 9 * 7 * 4 * 7)) + 8 * 2 * 4
(5 + 4 + 6) * (6 * 7 + 5 * 9 * 6) * 6 + ((4 + 5 + 3 * 5 + 6) * 6 + 2)
(4 * 7) * 2 * (2 * 9 * 6 + 8)
7 * (3 * 4 * 5 * 8)
(8 * (9 + 5 * 5 + 9 + 5 + 2) * 6) * (4 + 5 * 9 + (7 + 2 + 8) + 5 * 7) + 3
(2 * 4 * (3 * 4 * 5) + 5) * 2 + (6 * 4) + ((4 * 4) * 3 + 2 * 6) + 9 * ((7 * 6 * 8 + 2 + 7 + 9) * 7 + 3 * (8 + 7) * 6)
6 * 3 * (9 * 2 + 8)
2 + (6 * 4) * 7 * 7
2 + (9 + (9 + 7 + 3 * 4 + 6 * 7) * 9) * (7 * (5 * 8 + 8 + 6 + 6) * 7)
(2 + (5 + 5 + 9 * 4) + 3) * 2 + 2 * 6 * 4
5 * 3 * ((8 + 8 + 7 + 3 + 2) + 9)
((9 * 4 + 5 + 7) * 8 * 3 * 6 * (7 + 8 + 8 * 7 * 5)) + 5 + 8 * 9
(5 * 7 * 5 + (8 * 3 * 9 * 3)) * (8 + 7 + 8) + (2 + (3 * 7 + 4 * 8 + 4 * 3) * 3)
7 + 4 * (3 + 9 * 5 + 3 * 3) * (5 * 7 + 5 + 3)
(7 * 9 * 3 + (2 * 7 * 4 * 5 + 8 + 8)) * ((9 + 6 * 3) + 8 + (3 + 4) * 6 * 8 * 6) + 6 * 4
4 * (3 * 4 + 3 + 4 * 4 + 9) + 5 + 8
3 + 7 * (4 * (6 * 9 * 3 * 2 + 5 + 3) + 5) + 4 + 9
5 + 6 * 2 * 5 + (9 + 6)
4 * (4 * 6) + 7 * (3 * 3 + 6) * 8
((8 + 8) + (7 + 4) + 5 * (9 * 2 * 9 * 8) * 5 * (2 + 3 * 3 + 2 * 5)) + 5 * 7 * (4 * 7 + (3 + 3 * 5 * 5 + 5 + 2) + 8 * (2 + 2 + 9 + 6 + 3)) + 2
6 + 8 + (3 * (8 * 2 + 3) + 9 * 6 + (7 + 9 + 3 * 6) + (7 * 3 * 7))
7 + (5 * 7 * 6 * 3) + 5
7 + 5 + (3 + 8 * (6 + 8 * 3))
9 + (9 + 2 * 3 + 8 * 7) + 6 + (4 + 2)
(4 + 8 * 7 * 9 + 7 + (4 + 7 + 2 * 3)) + (2 + 7) * 6 * 6 * 6 + 9
2 + 5 + 8
6 + ((4 * 8) * 9 * 2 + 7)
6 + 9 + 6 + 4 * 5 + (8 * 9 + 9 + 4 + (5 * 3 + 8 * 7 * 4 * 7) + 5)
9 + (8 * 2 * 5 * 5 + 6)
(4 * 3 + (2 + 3 * 6 + 2) * (9 + 8 + 2 + 8 * 6 * 2)) + 9 + 3
((5 * 9) * (7 + 7) * 8 + 6 + 9 * 3) + (2 + 7 + 7 * 9 + 4)
((5 + 5 * 2 + 8 + 2) * (7 + 4 + 5) * (3 + 2 + 5 + 5 + 6) * 2) * 4 * 5 + 9 * 6 * 9
8 + (4 + (5 + 9 * 9) + 7) + ((7 * 3) + 7 * (4 + 7 * 5 + 8 + 7 + 9) * 3 * 5 + 3) + 4 * 3 * 4
((8 * 5 * 7 + 4) + 5) + 2 + (4 + (7 * 9 + 2 * 9 + 5 + 6) + 3 + 8 * (3 + 9 * 8 + 5 + 6 + 2)) * 7
6 * 9 * (3 + 9 + 9) + 7
4 + 4
(2 + (3 * 8 + 6 * 6 * 8) * 3) + ((3 + 6 + 2 * 6 * 6 + 4) * (7 * 4 + 4 * 9) + 3 + 5 * (7 * 3 * 9 * 4 + 3 + 2)) + 3
(2 + (7 * 3 + 4 * 8)) + 5 + 2
(3 + (8 + 9 * 2 + 4) * (9 * 7 * 8)) + (3 * 2) * 7 * 5
5 + 7 + 3 + ((2 * 9 + 8) + 9) * 7 + 7
(4 * 4 * 2 + (2 + 2) * 8 * 2) * 4 + (5 + 6 + 3 * 6 + 2 * 2) * 9 + 6 + 9
9 + 9 + ((8 * 5 * 6) * 3 + 2 * 2 + (2 * 4 + 7 + 6 + 7) * 3)
((6 * 9 + 6 * 3) * (5 * 7) + 2) + (2 + 6 + 6 + (6 * 3 * 3 * 5 * 5) * 4)
2 * 4 + 2 + 3 + 3
9 * 2 + 6 * 6 * 4 + 7
3 * (4 + (6 * 5 * 7 + 7 + 4) + 6 + 8) * 8 * 3 * 6 * 2
5 * (7 + (4 * 3 * 9) * 8 * 6) * 2
3 + 6 + (5 + 4) * 7 * 2
7 + (6 * 6 * 4) * 9 + 9 + 3
9 + ((2 * 5 * 7 * 9 + 2) * (2 + 6 + 7) + 8 * 2 * 9 + 8) * (2 + 2 + 6 * 8 + (8 * 6 + 3 * 6) * 3) * 6 + 8
(5 + 2 + 6) * (7 * 7 * 8)
(6 * 2 + 9) + 9 * (3 + 9 * 5 + 3)
5 + 2 + (6 + (9 + 2 + 5 * 5 * 8 + 5)) + 3 * 2 + (4 + 4 * 2 * 6)
6 + 4 * (8 * 5 + 4 * 2) + 8
9 * 6 * 6 + 2
7 * (6 + 2 + 4 * 5 + 6) * 6 * (6 + (8 + 9 * 9 + 9) * 8) + 8 + (3 + 2)
5 * 2 * (4 + 8) + 8 * 3 + (2 + 8 + 8 * 6 * 9)
3 + 6 * (8 + (2 + 9 + 5 + 2 * 6) + 3 * 9 * 7 + 2) + 3 + 5
(6 + 9 + 5 + 7 * (5 * 5 + 6 * 5) + 3) * 9 + 4
4 * (3 * 9 + (9 + 9 + 6 + 7)) * 8 + (2 * 8 + 2 * (2 * 8) * 4 * (4 + 6)) * (4 * 6 * (9 * 5 + 9 * 3 * 6) * 2) + 7
4 * 3 + (4 + 8 + 4) * 7 * 3 + 9
4 * 8 * 3 * (3 * (9 + 9 * 8 + 3 + 4) + 8 * 6 + 6)
2 + 8 * (5 * 4 + 3 + 9) * 2 * 8
3 * 8 + 4 * 6 + (5 * 8 * 3 * 8)
2 + 7 * (3 + 5 + 2 + 5) * 7 + 9 * 4
2 * 4 + 5 * (6 * 7 + 3 * 8 + 4) + (2 * (4 + 6 + 7 + 5 * 2 * 2) + (6 * 4 * 4 + 3 + 7) + 6 + 8)
3 + ((6 + 9 + 7) * (2 + 3) * 6) * 2 * (3 * 3 + (9 * 2 + 8) * 7) * 4 + 7
8 * (2 + 9) * (6 + (3 * 5 + 7 * 8 + 5 + 9) * 6 * 9) * 6
6 + 9 * 8 * 5 + (8 + 5 + 7 * (6 * 6 * 5) * 5 * 7) + (4 + 6 * 2 * 9 * 5)
2 * 8 + 3 * 4 * (2 * 8 + 7 + (6 + 9 * 7 + 2 * 9)) * 2
5 * (9 + (9 * 6 * 2 + 2) + 6 * 6) + (5 * 4) * 7 * 6
((9 + 8 * 7 * 4 * 2) + 3 + 3 * 5) * 8 + 5 + 9 * 4 * 5
9 + ((9 + 9) + 4 + 4 + 3 + 6 + (3 + 6)) + 6 * 9 + ((6 + 2 + 3) * 4)
6 + ((3 * 5 * 4 + 6) + 6 * 5 + 4 * 9 + (3 + 9 * 2))
3 + 3 + (7 + 8) + 8 * (4 * 9 + 8 * 9 + 9 * 9)
(5 * 9 * 7 * 4) + 6 + 3 * 5
(7 * 8 * 3 + 4 + (8 + 7) * 4) * 2 + 8 + 5 + 4 * 4
9 + (8 * 6 + 2 * (8 * 6 + 4 + 2 * 5 + 2) + 4)
(7 + 5 + (2 + 4 + 6)) + 9 + 5
(4 + 2 * 5 * 6 + 3) * 2 + 2
((7 * 8 * 8 + 8 + 5 * 6) * 6 * 8) * 5 * 4 * (7 + 3 * (8 + 6 + 5 + 8) * 8 + 9) * 3 * 9
3 + 9 * 8 * (7 + 8) + (9 + 6 + 5 + (8 + 4 + 6 * 5 * 9 * 7))
5 + 2 + 6
(9 + 2 * 7 + (9 + 3 + 6 * 7) * (9 + 3 * 4)) + 8 * 6 + ((3 * 6 + 8 * 6) + 4 * 4 * 8) + 6 * 6
3 + 7 * (8 + 7 * (7 * 2 + 6 + 4 + 3 * 9) + 8 * 7) * ((4 + 7) + 8 + 9 + 5) * 3 + ((2 * 8 + 2 * 3) + 3 + 8)
8 + 5 * 9 * (5 + 3 * 4 * 8 * 8) * 7 + (2 + 9 * 4 + 4 + 3 + 8)
6 + (9 + 4) + 4 + ((7 + 8 * 3 * 6) * 2 + 6 + 9 * 6) + ((2 + 2 + 3 + 3 + 5) * 5 + 5 + 8 + 7 + 4)
(4 + 6 + 7 + (7 * 4 + 7 + 2 + 2)) + 4 * ((9 * 9 + 8) + 3 * 3) + 4
5 * (4 + (6 * 9) * 2 + 5 * 8)
(7 * 5 + (6 + 2 * 3 + 3 + 2 + 7) * 6 + 5 + 8) + 3 + 5
(6 + 4 * 8 + 8 * (7 + 4 + 3 + 9 + 3)) * 5 + (3 + 7 + 4 + (2 + 6 + 5 * 2 + 2) + 7) * 8 + 4
8 * ((5 * 9 * 7 * 6) * 5 + 3) * 9 * (6 * 6 * 8 * 2)
((4 * 4) + 2) * 5 + 8
6 * (4 + (8 + 7 + 8 + 6)) + (9 + 5 * 5 * 6 + 9)
((5 + 9 * 6 * 7 + 7 * 3) + 8 + 2 * 8 + 9 * 5) * 2 * 9 * 4 * 6
(7 * 5 * 9 + 4) * 3 + 5
(5 + 5) + 8 * 9 + 2 * 8 + (7 + 4)
8 + (4 * 7 * (7 + 5 * 3 + 7) * 9) * 8
2 * (7 * 8 + (7 + 5 + 9 + 8)) * 9 + 9 + 9
9 + 8 + (2 + 6 * (9 * 2 * 7 * 7) + 5 + 2 * 5) + 4 + 5
(9 + 3 * 4 + 2 * 9) + (7 + 4 + 9)
2 * (5 * 5 * 6 * (5 * 6 + 2 + 9 + 5 * 3)) * ((2 * 5 * 6 + 5 + 8) + 8 * 2 + 7 * 9 * 2) + 7 * 2
9 * 2 + 7 + 3 + ((9 * 9 * 3 + 7 * 2) + 2 * 2 * (5 * 8 * 3 + 2 * 9 + 6) * 3)
4 + (4 * 9 * 2 + 9 + 9 + 2) + 6 * 2 * (7 + 9)
2 + 4 + (5 * 9 * 4 + (2 * 4 * 2) * (5 + 8 + 5 * 8 * 4 + 6) + 2) + 9 + 6
(7 + 9 * 7 + 8 + 3) * 7 * 6 + (2 + 9 * 7 + 5 * 5) + 2 * ((4 + 3 * 5 + 8) + 7 * 3 * 6 * 9 * 6)
(4 * 8 + 8 * 2) + 5 + (5 * 7 + 6 + 2 + 7 + 2) + 3
9 * (5 * (2 + 3 + 4 * 3)) * 5 + 9 + 9 * 9
9 * 5
5 + (9 * 6)
7 + 7
3 * 4 + 3 + (7 + 3 + 4 + 8 * 4)
8 * (5 + 3 + 3 + 2 * (4 + 6)) + (8 + 5 * 9) * 6
5 + (2 + (6 * 2)) + 5 + 8 * 9 * 3
(9 * 4 * 6 * (4 + 8 * 5) * 5 + 6) + 2 * 8 + 6 * (3 * (6 * 2 * 9 * 4 * 2 * 8) + 9 + (8 * 9 + 3 * 4 + 3 + 8) + 4 + 7)
8 * (5 * 8) + (7 + 7 * 5 * 6 * 3 * 4) + (4 * 7) * (3 * 6 + 9 * 4 * 2)
2 + (8 + 7 * 2 * (6 * 4 + 9 + 7 * 8) + 2) + 4 * 4
2 * (7 + 3 + 2 + (9 + 4 + 8 + 9)) * 2
9 * 8 + ((9 * 8) + 8 + 9 * 3 * 6 + 8) + 5 * 6 + (7 + (3 + 5 + 8 + 7) + 2 * (7 * 5 + 5 * 7) * (8 + 3 + 8) * 4)
2 + 5 + 4 * (6 * 2 * (8 + 8 + 7) + 3 * 9 * 9)
(5 * 5) + 4 * 9 + 8 * 8
((4 + 5 * 4 + 2) + (2 * 9)) * (2 + 4 + 3 * 9) * 9 + ((2 + 7) + 9 * (3 + 6 + 2 + 3) * (7 * 8 + 5 * 6) * 9) * 8 * 6
2 * 9 * (8 * 6 + 6) + 4 * (5 * 8 * 6 * 4)
6 * 7 * 2 * 3 + (8 + 8) * 6
(5 * 7) + 3
8 * 2 * (8 + 8)
5 * 7 + (6 + 4 * 3) + 3 + 9
6 * 2 * 6 * 2 + 8 * 4
(2 * 8 + 9 * 6 * (7 + 3 + 4 * 4 + 4 * 9)) + 2 + (6 + 3 * 5 + 4 + 9 + 8) + (3 * 7 + 3 * 2 + 6)
((3 * 8 * 8 * 4 + 6 * 6) * 7) * 6
(2 + 6 * 2 * 8 * (2 + 6 + 5 * 6) * 4) + 9 * 2 + 7
3 + 4 * 4 + 8
((8 * 6 * 8 + 7) * 8 * 7) * 4 + ((5 + 3 * 9 + 2 + 3 * 4) + 2 + 6 + 4 + (4 + 3 + 2)) * 7
((6 * 9 * 4 + 5) * 5) * 7 * 3 * 7
2 * 5 + 8 * ((6 + 5 * 6 * 5 * 3 * 2) * (7 * 7) * (8 * 3 * 3 * 3 * 8) * (6 + 8 * 9 + 9 * 4)) * 5 * 6
6 * ((6 * 7) + 9)
8 + 2 + 5 * 3 * ((4 + 3 + 8) + 7 + 5 * 6 * (2 * 6 * 2)) * 9
(5 * 5 + (2 * 9 + 8) + 8 * 8 * (3 * 6)) * 9 * 3 * 2
(9 * 8 * 7) * 7 + 7 * 4 + 8 * 7
((3 + 8 + 2 * 7) + 3 + 7 * 2) + 4 + 3
6 * 5 + 3 + (4 + 6 * 2 + (2 * 7)) + 2 * 2
7 * (4 * 9 + 3 + 4 * 2 * 5) * 9 + 7 * (9 + 6 * 7 * 8) * 3
((2 + 2) + 8 * 7 + (5 + 6 * 7 * 9 * 3) + 6 + 4) * 9
((6 * 5 * 2 * 4) * 6 * 6 + 2 + 7 + 6) + 2
7 * 4 + 3 * 3 * 9
5 * ((3 + 9 * 2) * 6 * 3 * (5 * 3) * 6 + 6) * 4
(3 * 7 * 9 + 9 * 6) * 5
6 + (8 + 5 * 3 * (7 * 6 + 5 + 4 * 7 + 8))
4 * 2 * 4 * (7 + 8 * (7 * 5 + 3 * 3))
((5 + 9 + 4 * 2) * 2 * (7 * 3 + 7 + 3 * 8 + 6) + 9 + (2 + 6 + 7 * 2 * 9) * 8) + 7 * (4 + 4)
9 + (7 * (8 * 2 + 5 * 8 + 7) * 7 + 6 + 6 * 2) * 2
(2 * 4) + 6 + (8 * 7 + 8 * 2 + (5 * 7 + 9 + 8 * 8))
3 + (3 + 2 * (5 * 4)) * 2 + (4 + 2 + 6 * (4 + 7 + 2)) * 3
(9 * 6 + 9) + (9 * 8 * (4 * 6 + 5 * 6 * 4)) + 3 + 2 * (9 + 3 + 5 + 5 + (4 + 8 + 8 + 2 * 5))
(8 + 7 * 3 + 2 * 5 * 4) * 4 * 9 + (2 + 5)
6 * 5 + 6 * 9 + 2
(3 * 3 + 5 * 6) + 2 * 5 * 3 + 8 * 7
(8 + 9) * 5 * 7
7 + (2 * 8 + (6 + 5 + 2 + 3 * 8 + 3)) * 8 * 3 * 4
(6 + 9 * 2 * 2 + 4 * 7) + 2 * (9 + 9 + 8 + 9 + 7) + (2 + 5 * 6 * 3 + 3 + 3)
3 + 3 + ((2 + 2 + 9 * 8 * 9) + 4 * 8 + 6 + 8 + 6) * 9 * (4 + (8 * 8 + 5 * 9 * 9 * 9) + (3 + 4) + 6 + 9) * 7
9 + (3 + (4 + 6 + 9 * 2 * 7 * 4) * 9) + 9
7 + (4 + 8) * 2 * 9 * 9
6 + (9 * (5 * 4 * 3 * 5) * 4)
3 * 8 + 4 + 2 + 5 * (4 * (8 * 6 + 2 * 5 + 8 * 4))
(4 + 9 * 3) * 2
5 + 3 * ((9 + 6) * 5 * (3 + 8 + 4))
((9 + 5 * 2 + 9) + 7 + 6 + 9 * (3 + 9 + 6)) + 4 + (3 + (9 * 3 + 7 * 9) * 6 + 9 + 9)
(9 + 6 + 6) + 3 + ((6 + 5) * 6 + 9 * 7) * (8 * (5 * 5 * 3 + 8 + 5 * 4) + (7 + 8 + 3 * 2 * 3 * 8) * 8 + 8) * (7 * (8 + 6 + 9 + 8) + 4 + 3 * 6) * 3
6 + 2 + 4 * (5 + 6 * 6) + 6 + 5
(2 * 7 + 5 + (4 * 4 + 8 * 5) * 4) * 6 * (4 + 2 * 2 * 3)
9 + (8 * 8 * 8 * 2) + 8 * 5 + 5 + (3 + 6 + 4 + 6 + 6)
(3 * (2 * 5) * 6 * 9 * 9 * (7 + 5 + 3)) + 6 + (4 + 2 * 9) * (2 * 6 + 7 + 6 + 3) + 4
3 + 7 + 6 * 6 * (4 * (6 * 6)) + 5
(7 + 2) + 4 * 3 * (5 + 9 + 6)
4 * 7 * (6 * 8 * 3 * 6 + 5) + (8 * 8 * 4 + 5) * 4
9 * 3 * 8 + 7
3 + 7 + 3 + (6 * (2 * 2 + 7 * 4)) + 8
5 * 6 * (7 * 9 * (4 + 8) + (5 * 3 + 7 * 4 * 7))
3 + 4 + 2 + ((6 + 5 * 7 * 8) * 9 * 8 * 8)
(5 + 5 * 2) * 6 + 3 * (4 * 5 + 5 * 5 * 2) + 4
(4 + 4 + 9 * 7 * 9) * 3 + (3 * 4) + 5 * 6 + 7
6 * (4 * 5 + 6 * 3 + 3 * 3) * 8 + 2 * 8
3 * (3 * (4 + 3 * 2 * 5) * (2 + 4 * 5 + 8) * 5 + 3 * 8) * 6
6 + (2 * 3 * 7 * 8 + 7) * 4
4 * 9 * (7 + 6 + 5 * 6 * (8 * 9) + 9) + 8 * (9 * 2 + 9) + 6
9 * 5 + 4 * ((3 + 6 * 4 + 4) + 8 + 4 + (7 + 4 * 3 + 7 * 5 + 9))
3 + ((9 * 4 * 6 + 4) * 4 * (7 + 3 + 8 + 7 + 3 * 4)) + 7 * 4 + 5 * 6
(8 + 2) * ((4 + 8 * 8) * 8) * 5
2 + 8 * 8 + (5 * 7 + 3 * 4) * 4 + 4
5 * 5 + 3 * 8 + ((7 + 5) * 3)
(5 + 8) * (4 * 3 * 9 * 8) * 7
(3 + 4 * (5 + 4) + 7) + (7 * 9 * 3) + 2 * 4
2 * 3 * ((6 * 2 + 8 + 2 * 9 + 5) * 3 * (4 + 4 * 3 + 2) + 8 * (7 * 3 * 5 * 9 + 3) * 8)
3 * 4 * (7 * 4 + 5 + 8 * 5) + ((9 * 5 * 5) + 4 + (6 * 6 + 8 * 2 + 9) * 2) + (3 + 4 + 7 * 7 + 9 * 5)
6 * 2 + 8 * 4 * (9 * 4 + (5 * 3 + 8) + 3 + 9) + 2
5 + (9 * 4 + 4) + (5 * 8 * 6 + 7 + 2 + 2) * 3 + (3 * (4 * 4 + 6) + 4)
5 + 8 * (5 * 7 * 8 * 4 + 6)
8 * 3 + 4
6 + 2 + 5 + 4 * (9 + 2 * 9) + 5
5 + 2 + 6 * (4 * (8 + 7 * 6 * 7) + (4 * 4 + 7) + (2 * 3 + 3 * 4 + 6 + 3) * 4 + 4) * 3
((5 * 4 * 2 * 4 + 9) * 4 + 3 + 4 * 7 + 8) * 3 * 6 + 4 * 2
(9 + 7) * 7 * 7 * ((6 * 3 * 4 * 8) + 9) + (7 + 4 * (3 * 3 + 6 * 2 + 7) * 9)
9 * (7 * 4 + 9) * (8 * 2 * 5 * 7 * (8 * 3 + 9 + 3 * 4) + 6) * 2 * 3 + 3
8 + ((3 * 5 + 3) + 5 * 7 * 8 * 8) + 3
((9 + 3 * 5 + 2) * 6) + 9 * (5 * 5) * 6
5 + (5 * (5 * 8) * 9 + 2) * (8 + (7 + 4 + 9 * 6 * 6 + 8)) * (4 + 8 * (6 + 6) + 7) * 3
5 * (2 + (6 + 9 * 4) + 4 * (8 * 2 + 7) * 8 * 2) * 6 * (7 + (6 + 8 * 6 * 8) * 6)
(7 * 7 * 5 + 8 + 2 + 3) * 3
5 + 3 + 3 + (6 + (3 + 7)) * (4 + 6 + 9) * 8
4 + 3 * (9 + (5 * 8 * 8 * 5 + 3) + 4 + 2 + 9)
2 + 7 + 5 * 6 + ((4 * 6 * 9 * 2 + 2 + 5) * (7 + 2 * 4 * 7 + 8) + 8)
(9 + 7 * 8 * (6 * 5 + 7 * 3)) + 4 * 7 + 5 * 9 + 9
((7 * 7 + 7 + 2) + 9 + 5 + (8 + 6 * 3 * 6 + 9) * (6 * 2 + 4 * 7) * 9) + 6
(3 + (3 * 4 * 6 + 4)) * 7
(6 * 2 * (5 + 5 + 4 + 7 + 8)) * 6 + 4 * 4
4 * 8 + (5 + 8) + 3
3 + 8 + 3 * (9 + (5 * 4 * 9) * 5) * (8 + (6 * 7 * 3 + 7 * 6) * 2) * 8
3 + 8 * (2 * 8 * 5 + 2) + 2 * ((8 + 7 * 6 + 5 + 2) * 6 * 3 * 3 * 5) * (7 * (5 + 5 + 3 * 6 * 3) * (5 * 4 + 4 * 9 + 4) + (9 + 9 + 9 * 5) + 7 * 3)
5 + (9 + 5 + 9 + 7 + (3 + 4 + 3 * 8)) * 8
4 * (9 + 4) + 4 + 3 + 6 + 9
((5 * 4 * 8 * 8 + 8 + 7) + 4) + (5 * 8 + 2) * (8 * 7 * 4 + 9 * 4 + (4 * 2 * 7 + 6)) + 3 + 6
5 * (8 + (9 * 9 * 5 * 2 + 8 + 4) * 6 + 6) + (7 * 5 * 7 * (9 * 2 * 8 + 5 * 7) * (5 + 4 + 2 * 8 * 8 * 9) * 4) + 6 + 9
((4 * 4 * 8) + 8) * 7 * 3 + 8 * 7
5 + 4 * 2 + 8 * (7 + 2 + 9 * 2) + 4
5 * (4 + 9 + (3 * 4 * 5) * 9)
4 + 2 + 3 * 3 + 9 * (9 + 4 * 9)
5 * 4 + 3 * 8
(8 + 4 * 6) * (8 * 3 + 4 * 8 * 9 * 2)
(9 + (8 + 4)) * 6
(9 + 5 * 5 * 8 + 7 * (9 * 6 * 6)) + 2 + 4 * 2 * (3 * 8 * (5 * 5 + 5 * 7) + 8 + (3 + 7 * 5 + 4 * 5) + 5) + 9
3 * 9 + 2 * (7 + 8 + (9 * 6 + 4) * (4 + 8 * 9 + 2 + 3) + 3)
(4 + 7) * 3 + 7 * 5
6 * (4 * 5 + (2 + 7 * 8 + 9 + 5) * 7 + 9 * 2) + 8
8 * (8 * 3 * (3 * 3 + 2) + 9) * 5 + (7 * 3 * 2 * 4)
9 + 3 + 4 * (8 + 4 * (2 * 8 * 3) * (5 * 4) * 7 + 5) * 8
8 * 9 + 6 * (3 * (6 * 8 * 6) + 7 + 9 * 5 * 7) * (7 * 3 + 3 * 6 * 8)
8 + (8 * 6 + 7 + 2 * (4 * 6 * 3))
4 + 2 * 7 * ((7 + 6 + 7) * 8 * 6) * (2 * 7 * (2 + 4 + 9 + 2) * (4 + 3 + 6 + 2 + 6) + 6 + 7)
(3 + 9) * 7 + 5 * (3 + 3 * 2 * 6) * 3 * 2
(5 * (8 * 3 + 6 + 5 * 9) * 8 * 6 + 9 * 9) + 8 + 5
8 + ((9 + 3 + 2) * (7 + 9 * 6 * 3) + (4 + 6 * 5 + 8 + 3) * (6 + 9)) + 9 * 7 * 7
2 + 9 * 3 * ((6 + 3 + 3 + 6 * 7 + 9) + 8 + (5 * 5) * (4 * 8 * 5) * 3)
8 + 6 + 4 * 2 * ((5 * 8 + 9 * 2 * 3) * 3 * 9 + 4 * 9 + (3 + 5 * 9)) + 2
7 * ((6 + 8 + 5) + 9) * 4 + 4
9 + 3 * 4 * (6 + (9 * 3 + 7 * 3 + 7 + 3)) * (4 * (4 * 3 + 4))
7 * (5 + 7 * 5) + 2 + ((7 + 6 * 7 * 9) + 5 + 3 + 9 + 6) * (7 + 4) * 2
2 + 4 * 5 + 6 * 3
2 * 9 * ((9 * 5 * 8) + (8 + 3 * 8)) + (7 * 8)
7 * 6 + 5 + (5 * 4) + 9 * 2
4 * 5 + 2 + (4 * 4 * 7) + 4
5 + 5 + 2 * (8 * (3 + 5 + 9 + 4) + 7) * 3
3 + ((2 * 8 + 7 * 3 * 3 * 4) * 3 + 9) + ((6 * 9 * 4) + 4) * 8 * 6
((2 * 5 + 4) * 2 + (3 + 4) * 8) * 7 * 9 + 2 + (9 * 7 * 8 + 5 + 9) + 8
7 * (9 * (5 * 3 * 2) * 7 * 5 + 3 + 7) + 7 * 9 * 3 + 6
((3 * 3) * 7 + 9 * 7) * 6 * 8 + (4 * 3 + (7 + 4 * 2) * (5 * 9 * 6 + 4 + 6 + 4)) * 2
3 * 6 * 2 + ((4 * 9 + 7) + 6) * 3
9 * (3 + 8) * 6 * 3 * 7 * (4 * 3 + 7 * 2 + (8 + 7 * 6 * 2 * 8 + 3) * 3)
((5 * 4 * 5 * 6) * 8 * 8) + 8
((2 * 9 + 2 + 6 * 5) * 4 * 2 * (4 + 4 * 9 + 3 * 2 * 8)) * 4 * 7 * 3 + 4 + 7
6 * 3 + 5 * 4 + 8 + 9
8 * 2 + (7 + (6 + 4) * (6 * 5) * 3 * 7 * 8) * 2 * 9 + 5
6 + (3 * 2 * 9 * 8 * 5) * 2 + 6 + ((6 * 8 * 7 + 5 * 9) + 3 * 3) * 5
(8 + 3) + 3 * (3 * 3 * 7) + 8 * 8 + 3
6 + 2 * (2 + 2 + 9 * 2)
(7 * 2 * 6 * 3 * 4 + (7 + 6 + 6 + 3 + 2 * 7)) * 8
(7 + 2 + 2 + (9 + 8) + 3) + (4 + (5 + 7 * 6 * 2) + 7 + 9 + (2 * 8 * 4 * 3 + 6)) * (6 * (9 * 6 + 4 + 7) + 8) * 6 + 2 * 6
6 + 5
(9 * (6 * 9 * 2 + 3 + 5) + 7 + 2 + 4) + 8 * (6 + 5 * 9)
8 * (5 * 8) + 5
9 * 2 * 9 * 9 + 7
(8 + 9 + (8 + 7 * 4 + 4) + 4 + 2) + 6 * ((9 + 4 * 9 * 3 + 5 + 2) * 8 * 3 * 8 * 3) + 8
5 + (8 * 4 * 5)
(3 * 7 * 4) + 6 * 8 * (5 + 4 + 8 + 5) * (4 + 8 + 9 * 8 + 7 * 7) + (4 * 8 + (5 + 4 + 2 * 2))
9 + 6 * 7 + 2 * (9 * (3 + 2 + 7 * 9) * 3 * 4 * (6 * 6 * 9 + 4)) + 9
7 + (8 * (5 + 7 * 6) * 8 + (2 * 4 + 5 * 4 + 6 * 7) + 3) + 9
5 + 7 * (3 + 8 + 2 * 8 * 5 + 4) * 7 * 8 + 8
9 * 4 * 4
(9 * 3) * ((5 * 7) * 8 * 2 + 4) + 5 + 9 * 3 + 5
((2 * 5) + 2 + (7 * 5 * 9) * 2 + 5) + 7 + (5 + 2 + (8 + 4 * 4 + 6))
((5 + 4 + 9) * 4 * 4 * 6) * 4 * 6 + 5
4 * 8 + 3 * ((8 + 8) * 5 * 7 + 9)
8 * 6 + 5 + (5 * 9 + 5 * 7 * (9 + 8 * 7) * 5)
7 * (3 + 4 * (3 + 6) + 6 + (3 * 8) * 9) + ((8 * 5 + 3 * 8) + 2 + 3) + (9 + 6 * (6 + 8 + 6 * 8 + 8 + 6)) * 2 * 7
8 + ((6 + 6 + 5 + 3 * 3) * 5 * 8 + 9) + 2
((9 + 8 * 8) * 8 + (6 + 2 + 7 + 3 * 3 + 6) + 2) * ((2 + 3 * 7 + 6) + 3 * 7 + 8 + 6 * 6) * 3 * 8 + 9
5 + (8 * (4 * 2) * 2 + 9) * 2 * 6
(4 + 4 * 9) + (6 + 5 * (4 + 2 * 2 * 4 * 8) * 2 + 4)
6 + 7 + 5 + (6 * (2 + 6 * 2 + 5 + 9)) * 6
5 * 3 + 2 + 2 * ((7 + 6 * 8 + 6 * 7 + 5) * 4)
6 * (7 * 8) * (6 + 6 + 2 + 4 + 6 + 6)
((7 + 3 * 7 * 4) + 7 + 9 * 4) + 4 * (2 * 9 * 7 + (3 + 9 * 3)) + 8 * 9
2 * 3 * 2 * 5 + 9 * 6
((3 * 7 * 9 + 4 + 5 + 3) * 8 + (4 + 5 + 8 + 3) + 2 * 2) * 7 * 5
3 + ((8 * 2) + 8 * 4 + 2) * 4 + 9 * 5 + 5
3 + 9 + (6 * 9 * 8) * ((8 * 3 + 9) * 4 + 5 * 7 + 6) + 7
9 + (8 * 4 + 2 * 6 * 4 * 4) * 9
5 + 3 + 5 * 3 + 4 * 3
(5 * 3 * 4) + 7 + 8 + 6 + 5
(6 * (9 * 7 + 5) + 7 * 4) * 2 * 9 + (7 + 5 * 4 + 7 + 3 * 6)
6 * 9 + 2 * 2 + (6 + (6 * 6 + 2 * 4 + 8) + 7 * 5)
((5 * 9 + 3 * 6) + (5 + 2 + 3 * 4) + 3 + 8) * (9 * 2 + 7 * (8 * 5)) * 6 * 2 + 5
(9 + (5 + 7 + 2 * 9) * 4 * 2) * 5 * 5 + 7 + 7 + 9
9 + 7 + 4 + (9 * 7 + 2 * (5 + 4 + 3 * 4))
6 + (3 + 5 * 4 * 8 + (7 + 4 * 3 * 4)) * 7 * 4
9 * ((7 + 6 * 3 * 6) * 7 + (4 * 5 * 3)) + 9 + (7 * 6 + 8 * 5) + 9
4 + 7 * 6 + 6 + (7 + (7 + 8 * 7 + 8 * 4 * 9) + 3 * 9) + 7
(9 + 7 + 2) * 3 + (7 * 8 + 9)
2 + 4 * (2 * 8 + (7 + 5) * 6) + 4 + 4 + (3 + 2)
(5 + (2 * 4 + 9 * 6) * 9 + 3 * 7 * 3) + (5 + (2 * 4 + 7 + 6) * 4 + 3 + 2) * (7 + 9 + (6 * 9 + 6 * 9) + (2 * 2 + 5 + 5) * 4 + 7)
(8 * 6 * 8 * 7 + 7 + 6) + 8 + 9
6 + (3 * 4 + 6) + 9
5 * 2 * 6 + 2 + (4 * 8 * 2 + (4 + 7 + 3 * 8 + 2)) * (4 + 8)
(4 + 2 + 7) + (7 * 2 * 3 * 8)
(9 * 6 * 2 * 9 * 7) * 4 + 4 * 4 + 4 * 8
9 * 3 * (9 + (5 + 3 + 2 + 6)) + (8 * 6 * 4) * 8
8 + (6 + 3 * 6) * 2 * 8
5 * 4 * 3 + (9 * 8 + 6)
(2 + 4 * 8 * 9 * 9 * 2) + 7 + 7 + 3 * 8
(2 * (4 + 7 + 8 * 4) * 4 * 6 * 7 + 4) * 6 + 5 * (6 + 4 * (6 + 9 * 2 + 2) + 2 + 5) * 4 * 5
(9 + 4 * 8 * 8) * 8 * (6 + (8 * 5) * (2 * 7 * 4 + 4 * 6) + 3 + 4 + 9) + 9 * 9 + 4
(7 * 4 + 3) + 4 + 7 * 9 * 7 + (6 * 3)
4 * 2 + 8 + (3 * 2 * (4 * 8) + 3)
6 + 6 * 3 + (9 * 5 * 5 + 4 + 9 * 9) * 3
2 + 8 * (2 + 8 + 2) + (8 * 6 * (3 * 6 * 4 + 8 * 6 * 6) + (3 + 5 + 7 * 8)) * 9 * (4 * 9 * 5 * 6 * 5 * 7)
4 + ((8 + 9 * 5 * 6) + 3 + 9)
(5 + 5 + 5 * 6 * (6 * 5)) * 7 * 2
4 + 6 + (7 * 2 * (9 * 7 * 5 + 5) + 4 * 2) + 9 * 9 * 2
6 + 9 * 8 * 3 + 9 * (3 * (3 * 2 + 2 + 9 + 7) * 2 + 2 + 3 * 8)
8 * 6 * (9 + 7 * (8 * 9 + 7)) + 8 * (3 + 3 + (4 * 2) + 4 * 7 + 4) * 4
9 * 2 + 2 * 4
(6 + (6 + 9 + 3 + 5 + 6)) * 8 + 8 + 3 * 8 * 9
(8 + 2) + 3 * ((2 + 2 * 5 * 2 + 9 + 6) * 6 * 6 + 3 + 3 + (5 + 9 + 7 + 5 + 9)) * 2 * ((4 * 7 + 4) * 6)
(4 + 8 * (9 + 8) + 2 + 4 * 2) + (7 + 5 + 3 + 9 * 4)
8 * 5 + 8 + (7 + 2 + 8 + 7 + 8) * (9 * 7)
7 + (9 * (9 * 4 * 8)) + (8 + 8 * (2 + 6 + 2 + 6) + (7 * 9 * 2 + 3 + 8 + 7)) * ((5 + 4) + 6 + 3) * 2 + 7
6 + ((4 + 2 * 5) + 3 * 7) * 2 + (4 + 9) * 3 + 3
9 * 4 + 7
((5 + 6 + 6 * 3 * 5 * 8) + 8 + 4) * 6 * 5 * 4
6 + ((4 + 7 * 6 * 4) + 8 * 2 + 6)
7 + 4 * 8 * 8 * 3 * (7 * 6 + 6 + (8 * 6 * 9))
((8 * 5 + 7 + 3 + 7) + 3 + 7 * (4 + 2 * 9)) + (7 * 6 + 2 + 5 + 6) + 2 * 6
(9 + 4) + 2 + 8 * (6 + (7 + 8 * 9 + 6 * 8) + 6) + 3
6 + (6 * 7 + 3 * 7 * (2 + 2 * 2 * 2) * 8) * (2 * 6 * 7 + 4 * (9 + 9 * 3 + 4) + 4) * 6
(6 + 9 + 6 + 8 * 5) * 8 * ((4 * 9 + 2 + 7 * 6 + 4) + (7 + 2 * 4 + 5)) * 3
((9 * 8 + 9 + 8 * 2 * 3) + 7 * (4 * 6 + 7 * 3 + 2 * 3) + 9) * 7 * 9
(3 + 6 + 7 + 9) * (2 + (4 * 7 * 6 + 9 + 3 + 5) + 9 + (2 + 3 + 7 + 4 + 3) + 9) + 8
(6 + 8 * 2) + 3 + 7 * 5
7 * (5 + 4 * 5 + 9 + 6 * (3 + 4 + 4 + 8 + 4))
(4 + 7 * 5 + 4 + 6) + (3 + (5 + 4)) * 3 * (2 * 4) + 2 + 6
(6 * 4) + 8 * (4 * (8 + 7 + 3)) + 4
5 + 6 * 8 + 3 + (7 * 5 + 5)
7 + 2 * 5 * ((8 + 4 * 8 + 3 * 5) + (8 + 4) * 6 + 4 + 9 * 4) * 8
(3 * 3 * (7 + 7 * 7 + 7) * 5 * 9 * 9) * 4 * (5 * 2 * 9 + 8 * (4 + 2) * 7) * 9 + 8 * 4
5 * 7 + (7 * (2 * 4))
3 + (9 + (5 * 9)) + 8 * 4
9 * 5 * 3 + 3 + 3 * (9 * 6 * 6 + 2 * 4)
2 + ((2 * 7 + 4 * 4) + 8 * 6 * (9 + 4))
9 + (8 + (7 * 5 * 7 * 5 * 7)) + 2
(4 * 5 * 6 * 3) + 9
6 + (2 * 5 * 9 + 8 + 2) * (2 * 8 * 3 * 2)
3 * (5 * (3 * 5 + 3) + 5 + (2 + 6 * 8 * 2 + 4 + 6) * 2) * 9 * (6 + 6 + 3) * 2
(2 + 5 + 8) + (2 + 8 + 3 * 7 + 4) * 3 + 3 * 9
6 * 6
5 * 9 * ((6 * 5 + 9 + 9) * 6) * 4
5 + 5 * 6 + (3 * 5) + 5
3 + (8 + 8 * (6 + 9 * 4 + 8 * 6) + 6 + 7 * 3) + 2 + 8 * 6 * 7
(3 * 2 + 6 * 3) * 7 * 6 * 9 + 5
2 + ((6 + 4 + 7 + 5 * 3 * 8) * 3 * 5)
(3 * 9 * 5 + 3 + 2) * 4 + 8 + (6 + 3 * 8 * 8) * (7 + 5 + 8) + (8 + 9)
5 * 2 + 2 * 8 * 5 * (2 * 5)
INPUT;
}


class Calculator {

    public $bDebug  = false;

    private $iResult = 0;

    private $aLine = [];

    private $sLine  = '';

    private $sOperator  = '';

    public $iLastPosition  = 0;

    private $iSubLastPostion    = 0;

    public function __construct($sLine) {
        $this->sLine  = str_replace(' ', '', $sLine);
        $this->aLine    = str_split($this->sLine);
    }

    public function run() {
        foreach ($this->aLine as $iPosition => $item) {
            $this->iLastPosition    = $iPosition;
            if ($iPosition < $this->iSubLastPostion) {
                continue;
            }
            if (')' == $item) {
                break;
            }
            if ('(' == $item) {
                $sSub   = substr($this->sLine, $iPosition + 1);
                //echo "vsub : {$sSub}\n";
                $oSubCalcul = new Calculator($sSub);
                $item   = $oSubCalcul->run();
                $this->iSubLastPostion  = $iPosition + $oSubCalcul->iLastPosition + 2;

            }
            if (in_array($item, ['+', '*'])) {
                $this->sOperator    = $item;
                continue;
            }
            switch ($this->sOperator) {
                case '+' :
                    //echo "{$this->iResult} + $item = ";
                    $this->iResult  += $item;
                    break;
                case '*' :
                    //echo "{$this->iResult} * $item = ";
                    $this->iResult  *= $item;
                    break;
                case '' :
                    $this->iResult  = $item;
                    break;
            }
            //echo "{$this->iResult}\n";
        }
        //var_dump($this->iResult);
        return $this->iResult;
    }
}