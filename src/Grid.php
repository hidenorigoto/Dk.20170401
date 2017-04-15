<?php
namespace Hg\Yokohena20170401;

class Grid
{
    /**
     * @var GridElement[]
     */
    private $elements = [];

    /**
     * @param GridElement $element
     */
    public function addElement(GridElement $element)
    {
        $this->elements[$element->getSign()] = $element;
    }

    /**
     * @param $sign
     * @return GridElement
     */
    public function getElementBySign($sign)
    {
        return clone $this->elements[$sign];
    }
}
