<?php

class D17
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
        if (112 == (self::parse($aInput))) {
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
        if (12 * 11 * 13 == (self::parse2($aInput))) {
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
        $oEnergy    = new EnergySource($aInput);
        for ($i = 1 ; $i <= 6 ; $i ++) {
            $oEnergy->runCycle();
        }
        return sizeof($oEnergy->aCubes);
    }

    /**
     * @param $aInput
     * @return mixed
     */
    public static function parse2($aInput)
    {

    }


    private static $sTest = <<< TEST
.#.
..#
###
TEST;

    private static $sInput = <<< INPUT
..#....#
##.#..##
.###....
#....#.#
#.######
##.#....
#.......
.#......
INPUT;
}

/**
 * Class EnergySource
 */
class EnergySource {

    /**
     * Current actives cubes
     * @var array
     */
    public $aCubes  = [];

    /**
     * New Cubes
     * @var array
     */
    private $aNewCubes  = [];

    /**
     * @var int[]
     */
    private $aDimensions    = [
        'max' => ['x' => 0, 'y' => 0, 'z' => 0],
        'min' => ['x' => 0, 'y' => 0, 'z' => 0],
    ];

    /**
     * EnergySource constructor.
     * @param $aInput
     */
    public function __construct($aInput) {
        $z  = 0;
        foreach ($aInput as $y => $sLine) {
            foreach (str_split($sLine) as $x => $sCube) {
                if (Cube::ACTIVE == $sCube) {
                    $oCube  = new Cube($x, $y, $z);
                    $this->addCube($oCube);
                }
            }
        }
    }

    /**
     * @param Cube $oCube
     */
    private function addCube(Cube $oCube) {
        $this->aCubes[(string)$oCube]   = $oCube;
        foreach ($this->aDimensions ['min'] as $sDimension => $iValue) {
            if ($oCube->{$sDimension} <= $this->aDimensions['min'][$sDimension]) {
                $this->aDimensions['min'][$sDimension] = $oCube->{$sDimension} - 1;
            }
        }
        foreach ($this->aDimensions ['max'] as $sDimension => $iValue) {
            if ($this->aDimensions['max'][$sDimension] <= $oCube->{$sDimension}) {
                $this->aDimensions['max'][$sDimension] = $oCube->{$sDimension} + 1;
            }
        }
    }

    /**
     *
     */
    public function runCycle() {
        $this->aNewCubes  = [];
        foreach ($this->aCubes as $oCube) {
            $this->cubeCycle($oCube);
        }
        $this->aCubes   = [];
        foreach ($this->aNewCubes as $oNewCube) {
            $this->addCube($oNewCube);
        }
    }

    /**
     * @param Cube $oCube
     */
    private function cubeCycle(Cube $oCube) {
        if (in_array(sizeof($oCube->getActiveNeighbors($this->aCubes)), [2, 3])) {
            $this->aNewCubes[]    = $oCube;
        }
        $aNeighbors = $oCube->getNeighborPositions();
        foreach ($aNeighbors as $oNeighbor) {
            $this->activeCube($oNeighbor, $aNeighbors);
        }
    }

    /**
     * @param Cube $oNeighbor
     */
    private function activeCube(Cube $oNeighbor) {
        if (3 === sizeof($oNeighbor->getActiveNeighbors($this->aCubes))) {
            $this->aNewCubes[]  = $oNeighbor;
        }
    }
}

class Cube  {
    const ACTIVE  = '#';

    private $aPositions = ['x' => 0, 'y' => 0, 'z' => 0];

    private $aNeighbors = [];

    public function __construct($x = 0, $y = 0, $z = 0) {
        $this->x        = $x;
        $this->y        = $y;
        $this->z        = $z;
    }

    public function __set($property, $value) {
        $this->aPositions[$property]    = $value;
    }

    public function __get($property) {
        return $this->aPositions[$property];
    }

    public function __toString()
    {
        return implode(',', $this->aPositions);
    }

    public function getNeighborPositions() {
        $this->aNeighbors = [];
        if (empty($this->aNeighbors)) {
            for ($x = $this->x - 1 ; $x <= $this->x + 1 ; $x++) {
                for ($y = $this->y - 1 ; $y <= $this->y + 1 ; $y++) {
                    for ($z = $this->z - 1; $z <= $this->z + 1; $z++) {
                        if ($x == $this->x && $y == $this->y && $z == $this->z) {
                            continue;
                        }
                        $oNeighbors = new self($x, $y, $z);
                        $this->aNeighbors[(string)$oNeighbors]    = $oNeighbors;
                    }
                }
            }
        }
        return $this->aNeighbors;
    }

    public function getActiveNeighbors($aCube) {
        return array_intersect_assoc($aCube, $this->getNeighborPositions());
    }
}
