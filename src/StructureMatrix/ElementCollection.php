<?php
namespace Hg\Yokohena20170401\StructureMatrix;

use PHPMentors\DomainKata\Entity\EntityCollectionInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * Class ElementCollection
 * @package Hg\Yokohena20170401\StructureMatrix
 */
class ElementCollection implements EntityCollectionInterface
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @param string|int
     *
     * @return Element|EntityInterface
     */
    public function get($key)
    {
        return $this->data[$key];
    }

    /**
     * @param Element|EntityInterface $entity
     */
    public function remove(EntityInterface $entity)
    {
        assert($entity instanceof Element);
        unset($this->data[$entity->getId()]);
    }

    /**
     * @return array
     *
     * @since Method available since Release 1.4.0
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @param Element|EntityInterface $entity
     * @return ElementCollection
     */
    public function add(EntityInterface $entity)
    {
        assert($entity instanceof Element);
        $this->data[$entity->getId()] = $entity;

        return $this;
    }

    /**
     * @param $f
     * @return ElementCollection
     */
    public function map($f)
    {
         return new self(array_map($f, $this->data));
    }

    /**
     * @param $rotateCount
     * @return ElementCollection
     */
    public function rorate($rotateCount)
    {
        return $this->map(function($element) use ($rotateCount) {
            /** @var Element $element */
            return $element->rotate($rotateCount);
        });
    }
}
