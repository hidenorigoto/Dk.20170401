<?php
namespace Hg\Yokohena20170401\StructureMatrix;

class ToStructureMatrix
{
    /**
     * @var StartElementSelector
     */
    private $startElementSelector;
    /**
     * @var ElementTracer
     */
    private $elementTracer;

    public function __construct()
    {
        $this->startElementSelector = new StartElementSelector();
        $this->elementTracer = new ElementTracer();
    }

    /**
     * @param ElementCollection $elementCollection
     * @return array
     */
    public function convert(ElementCollection $elementCollection)
    {
        // 先頭要素の決定
        $startElement = $this->startElementSelector->select($elementCollection);

        // 回転
        $elementCollection = $elementCollection->rorate(
            $startElement->getFirstLineIndex() % count($startElement->getLines())
        );

        // 表記順の決定
        $elementCollection = $this->elementTracer->trace($elementCollection, $startElement);

        // 変換マップ作成
        $map = array_flip(array_values(array_map(function($element) {
            /** @var Element $element */
            return $element->getSign();
        }, $elementCollection->toArray())));
        $mapper = function($sign) use ($map) {
            return ($sign === null) ? null : $map[$sign];
        };

        // 行列の導出（並べ替え、記号をインデックスに変換）
        $matrix = array_map(function($sign) use ($elementCollection, $mapper) {
            return array_map(function($line) use ($mapper) {
                return $mapper($line);
            }, $elementCollection->get($sign)->getLines());
        }, array_keys($map));

        //$this->dumpMatrix($matrix);

        return $matrix;
    }

    public function dumpMatrix(array $matrix)
    {
        foreach ($matrix as $rowIndex=>$row) {
            echo $rowIndex . '    ';
            foreach ($row as $col) {
                if ($col !== null) {
                    echo $col;
                } else {
                    echo '-';
                }
                echo ' ';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}
