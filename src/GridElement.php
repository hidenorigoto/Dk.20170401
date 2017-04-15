<?php
namespace Hg\Yokohena20170401;

use Hg\Yokohena20170401\StructureMatrix\Element;

class GridElement
{
    /**
     * @var string
     */
    private $sign;
    /**
     * @var array
     */
    private $lines;

    public function __construct($sign, $connections)
    {
        $this->sign = $sign;
        $this->lines = $connections;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * 未使用の線をクリアする
     * @param $usedSigns
     * @return GridElement
     */
    public function clearUnusedLine($usedSigns)
    {
        $this->lines = array_map(function($line) use ($usedSigns) {
            return (strpos($usedSigns, $line) !== false) ? $line : null;
        }, $this->lines);

        return $this;
    }

    /**
     * Elementオブジェクトに変換する
     * @return Element
     */
    public function toElement()
    {
        return new Element($this->sign, $this->lines);
    }
}
