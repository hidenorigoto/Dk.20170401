<?php
namespace Hg\Yokohena20170401\StructureMatrix;

class ElementTracer
{
    private $tracedSigns;

    public function trace(ElementCollection $elementCollection, Element $startElement)
    {
        $this->tracedSigns = [];
        $tracedCollection = new ElementCollection([]);
        foreach ($this->tracer($elementCollection, $startElement) as $element)
        {
            /** @var Element $element */
            $tracedCollection->add($element);
        }

        return $tracedCollection;
    }

    private function tracer(ElementCollection $elementCollection, Element $startElement)
    {
        $this->tracedSigns[$startElement->getSign()] = true;
        yield $startElement;
        foreach ($startElement->getLines() as $index=>$line) {
            if ($line === null) continue;
            if (array_key_exists($line, $this->tracedSigns)) continue;
            yield from $this->tracer($elementCollection, $elementCollection->get($line));
        }
    }
}
