<?php
namespace Hg\Yokohena20170401\StructureMatrix;

use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Entity\Operation\IdentifiableInterface;

/**
 * Class Element
 * @package Hg\Yokohena20170401\StructureMatrix
 */
class Element implements EntityInterface, IdentifiableInterface
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
     * @return string
     */
    public function getId()
    {
        return $this->sign;
    }

    /**
     * @return int|null
     */
    public function getFirstLineIndex()
    {
        foreach ($this->lines as $index=>$line) {
            if ($line !== null) return $index;
        }

        return null;
    }

    /**
     * @param $count
     * @return Element
     */
    public function rotate($count)
    {
        if ($count > 0) {
            $a = array_slice($this->lines, 0, $count);
            $b = array_slice($this->lines, $count);
            $this->lines = array_merge($b, $a);
        }

        return $this;
    }
}
