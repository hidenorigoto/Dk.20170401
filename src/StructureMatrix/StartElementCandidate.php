<?php
namespace Hg\Yokohena20170401\StructureMatrix;

/**
 * Class StartElementCandidate
 * @package Hg\Yokohena20170401\StructureMatrix
 */
class StartElementCandidate
{
    /**
     * @var Element
     */
    private $element;
    /**
     * @var int
     */
    private $depth;
    /**
     * @var ElementCollection
     */
    private $elementCollection;
    /**
     * @var int
     */
    private $score = null;

    public function __construct(Element $element, $depth, ElementCollection $elementCollection)
    {
        $this->element = $element;
        $this->depth = $depth;
        $this->elementCollection = $elementCollection;
    }

    /**
     * @return Element
     */
    public function getElement(): Element
    {
        return $this->element;
    }

    /**
     * @return int
     */
    public function evaluate()
    {
        if ($this->score) return $this->score;
        return $this->score = $this->getScore($this->element, $this->depth);
    }

    private function getScore(Element $element, $depth)
    {
        $existingLines = array_filter($element->getLines());
        $score = count($existingLines);
        if ($depth > 0) {
            $score += array_reduce($existingLines, function($total, $line) use ($depth) {
                $element = $this->elementCollection->get($line);
                return $total + $this->getScore($element, $depth - 1);
            }, 0);
        }

        return $score;
    }
}
