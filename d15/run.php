<?php

class D15
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
        $aInput = explode("\n", self::$sTest);
        if (436 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
        $aInput = explode("\n", "1,3,2");
        if (1 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
        $aInput = explode("\n", "2,1,3");
        if (10 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
        $aInput = explode("\n", "1,2,3");
        if (27 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
        $aInput = explode("\n", "2,3,1");
        if (78 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
        $aInput = explode("\n", "3,2,1");
        if (438 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
        $aInput = explode("\n", "3,1,2");
        if (1836 == (self::parse($aInput))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
    }

    public static function run2()
    {
        $aInput = explode("\n", '1,12,0,20,8,16');
        var_dump(self::parse($aInput, 30000000));
    }

    public static function test2()
    {
        $aInput = explode("\n", "0,3,6");
        if (175594 == (self::parse($aInput, 30000000))) {
            var_dump('OK');
        } else {
            var_dump('KO');
        }
    }

    /**
     * @param $aInput
     */
    public static function parse($aInput, $iTarget = 2020)
    {
        $aSpoken = explode(',', $aInput[0]);
        $aIndex  = [];
        for ($iPosition = 0 ; $iPosition < sizeof($aSpoken) - 1 ; $iPosition++) {
            $iValue = $aSpoken[$iPosition];
            $aIndex[$iValue]    = $iPosition;
        }
        for ($iPosition = sizeof($aSpoken) ; $iPosition < $iTarget ; $iPosition++) {
            $iLastSpoken    = $aSpoken[$iPosition - 1];
            if (!isset($aIndex[$iLastSpoken])) {
                $iValue = 0;
            } else {
                $iValue = $iPosition - $aIndex[$iLastSpoken] - 1;
            }
            $aSpoken[]  = $iValue;
            if (!isset($aIndex[$iValue])) {
                $aIndex[$iLastSpoken]    = [];
            }
            $aIndex[$iLastSpoken]    = $iPosition - 1;
        }
        return $iValue;
    }

    /**
     * @param $aInput
     * @return mixed
     */
    public static function parse2($aInput)
    {
        $iReturn = 0;
        return $iReturn;
    }


    private static $sTest = <<< TEST
0,3,6
TEST;

    private static $sInput = <<< INPUT
1,12,0,20,8,16
INPUT;
}