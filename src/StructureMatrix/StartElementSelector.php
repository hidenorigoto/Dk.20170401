<?php
namespace Hg\Yokohena20170401\StructureMatrix;

/**
 * 先頭要素を選択する
 *
 * Class StartElementSelector
 * @package Hg\Yokohena20170401\StructureMatrix
 */
class StartElementSelector
{
    /**
     * @param ElementCollection $elementCollection
     * @return Element
     * @throws \LogicException
     */
    public function select(ElementCollection $elementCollection)
    {
        $candidates = [];
        $maxDepth = (int)(count($elementCollection) / 2);
        $depth = 0;
        while (true) {
            $candidates = $this->scoring($elementCollection, $depth);

            // 最小スコア
            $minimum = array_reduce($candidates, function($minimum, $candidate) {
                /** @var StartElementCandidate $candidate */
                return min($minimum, $candidate->evaluate());
            }, 9999);

            // 最小スコアの要素
            $candidates = array_filter($candidates, function($candidate) use ($minimum) {
                /** @var StartElementCandidate $candidate */
                return $candidate->evaluate() === $minimum;
            });

            $depth++;

            if ($maxDepth === $depth || count($candidates) === 1) break;
        }

        if (count($candidates) === 0) {
            throw new \LogicException('開始要素候補が見つかりません');
        }

        return reset($candidates)->getElement();
    }

    /**
     * @param ElementCollection $elementCollection
     * @param $depth
     * @return StartElementCandidate[]
     */
    private function scoring(ElementCollection $elementCollection, $depth)
    {
        return array_map(function($element) use ($depth, $elementCollection) {
            return new StartElementCandidate($element, $depth, $elementCollection);
        }, $elementCollection->toArray());
    }
}
