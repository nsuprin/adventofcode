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
        $oEnergy    = new EnergySource4D($aInput);
        for ($i = 1 ; $i <= 6 ; $i ++) {
            $oEnergy->runCycle();
        }
        return sizeof($oEnergy->aCubes);
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
    protected $aNewCubes  = [];

    /**
     * Neighbors cubes
     * @var array
     */
    protected $aNeighbors   = [];

    /**
     * EnergySource constructor.
     * @param $aInput
     */
    public function __construct($aInput) {
        foreach ($aInput as $y => $sLine) {
            foreach (str_split($sLine) as $x => $sCube) {
                if (Cube::ACTIVE == $sCube) {
                    $oCube  = $this->initCube($x, $y);
                    $this->addCube($oCube);
                }
            }
        }
    }

    /**
     * @param $x
     * @param $y
     * @return Cube
     */
    protected function initCube($x, $y) {
        return Cube::getInstance($x, $y);
    }

    /**
     * @param Cube $oCube
     */
    protected function addCube(Cube $oCube) {
        $this->aCubes[(string)$oCube]   = $oCube;
    }

    /**
     *
     */
    public function runCycle() {
        $this->aNewCubes  = [];
        foreach ($this->aCubes as $oCube) {
            $this->cubeCycle($oCube);
        }
        foreach ($this->aNeighbors as $oNeighbor) {
            $this->activeCube($oNeighbor);
        }
        $this->aCubes   = $this->aNewCubes;
    }

    /**
     * @param Cube $oCube
     */
    protected function cubeCycle(Cube $oCube) {
        if (in_array(sizeof($oCube->getActiveNeighbors($this->aCubes)), [2, 3])) {
            $this->aNewCubes[(string)$oCube]    = $oCube;
        }

        $this->aNeighbors += $oCube->getNeighborPositions();
    }

    /**
     * @param Cube $oNeighbor
     */
    protected function activeCube(Cube $oNeighbor) {
        if (3 === sizeof($oNeighbor->getActiveNeighbors($this->aCubes))) {
            $this->aNewCubes[(string)$oNeighbor]  = $oNeighbor;
        }
    }
}

class Cube  {
    const ACTIVE  = '#';

    protected $aPositions = ['x' => 0, 'y' => 0, 'z' => 0];

    protected $aNeighbors = [];

    private static $aInstances    = [];

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return Cube|mixed
     */
    public static function getInstance($x = 0, $y = 0, $z = 0) {
        $sKey   = implode(',', [$x, $y, $z]);
        if (!isset(self::$aInstances[$sKey])) {
            self::$aInstances[$sKey]    = new self($x, $y, $z);
        }
        return self::$aInstances[$sKey];
    }

    /**
     * Cube constructor.
     * @param int $x
     * @param int $y
     * @param int $z
     */
    private function __construct($x = 0, $y = 0, $z = 0) {
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

class EnergySource4D extends EnergySource {

    public function __construct($aInput) {
        parent::__construct($aInput);
    }

    /**
     * @param $x
     * @param $y
     * @return Cube
     */
    protected function initCube($x, $y) {
        return Cube4D::getInstance($x, $y);
    }
}


class Cube4D extends Cube {
    private static $aInstances    = [];

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $w
     * @return Cube|mixed
     */
    public static function getInstance($x = 0, $y = 0, $z = 0, $w = 0) {
        $sKey   = implode(',', [$x, $y, $z, $w]);
        if (!isset(self::$aInstances[$sKey])) {
            self::$aInstances[$sKey]    = new self($x, $y, $z, $w);
        }
        return self::$aInstances[$sKey];
    }
    /**
     * Cube4D constructor.
     * @param int $x
     * @param int $y
     * @param int $z
     * @param int $w
     */
    private function __construct($x = 0, $y = 0, $z = 0, $w = 0)
    {
        $this->x        = $x;
        $this->y        = $y;
        $this->z        = $z;
        $this->w        = $w;
    }

    /**
     * @return array
     */
    public function getNeighborPositions() {
        $this->aNeighbors = [];
        if (empty($this->aNeighbors)) {
            for ($x = $this->x - 1 ; $x <= $this->x + 1 ; $x++) {
                for ($y = $this->y - 1 ; $y <= $this->y + 1 ; $y++) {
                    for ($z = $this->z - 1; $z <= $this->z + 1; $z++) {
                        for ($w = $this->w - 1; $w <= $this->w + 1; $w++) {
                            if ($x == $this->x && $y == $this->y && $z == $this->z && $w == $this->w) {
                                continue;
                            }
                            $oNeighbors = new self($x, $y, $z, $w);
                            $this->aNeighbors[(string)$oNeighbors] = $oNeighbors;
                        }
                    }
                }
            }
        }
        return $this->aNeighbors;
    }
}

