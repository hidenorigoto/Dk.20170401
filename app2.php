<?php
namespace App;

use Hg\Yokohena20170401\Grid;
use Hg\Yokohena20170401\GridElement;
use Hg\Yokohena20170401\StructureMatrix\ElementCollection;
use Hg\Yokohena20170401\StructureMatrix\ToStructureMatrix;

require_once __DIR__.'/vendor/autoload.php';

$matrixConverter = new ToStructureMatrix();
$grid = initGrid();


function initGrid()
{
    $grid = new Grid();

    $grid->addElement(new GridElement('a', [0=>null,1=>'b', 2=>'f', 3=>null,4=>null,5=>null]));
    $grid->addElement(new GridElement('b', [0=>null,1=>'c', 2=>'g', 3=>'f', 4=>'a' ,5=>null]));
    $grid->addElement(new GridElement('c', [0=>null,1=>'d', 2=>'h', 3=>'g', 4=>'b' ,5=>null]));
    $grid->addElement(new GridElement('d', [0=>null,1=>'e', 2=>'i', 3=>'h', 4=>'c' ,5=>null]));
    $grid->addElement(new GridElement('e', [0=>null,1=>null,2=>null,3=>'i', 4=>'d' ,5=>null]));

    $grid->addElement(new GridElement('f', [0=>'b', 1=>'g', 2=>'k', 3=>'j', 4=>null,5=>'a']));
    $grid->addElement(new GridElement('g', [0=>'c', 1=>'h', 2=>'l', 3=>'k', 4=>'f', 5=>'b']));
    $grid->addElement(new GridElement('h', [0=>'d', 1=>'i', 2=>'m', 3=>'l', 4=>'g', 5=>'c']));
    $grid->addElement(new GridElement('i', [0=>'e', 1=>null,2=>'n', 3=>'m', 4=>'h', 5=>'d']));

    $grid->addElement(new GridElement('j', [0=>'f', 1=>'k', 2=>'o', 3=>null,4=>null,5=>null]));
    $grid->addElement(new GridElement('k', [0=>'g', 1=>'l', 2=>'p', 3=>'o', 4=>'j', 5=>'f']));
    $grid->addElement(new GridElement('l', [0=>'h', 1=>'m', 2=>'q', 3=>'p', 4=>'k', 5=>'g']));
    $grid->addElement(new GridElement('m', [0=>'i', 1=>'n', 2=>'r', 3=>'q', 4=>'l', 5=>'h']));
    $grid->addElement(new GridElement('n', [0=>null,1=>null,2=>null,3=>'r', 4=>'m', 5=>'i']));

    $grid->addElement(new GridElement('o', [0=>'k', 1=>'p', 2=>'t', 3=>'s', 4=>null,5=>'j']));
    $grid->addElement(new GridElement('p', [0=>'l', 1=>'q', 2=>'u', 3=>'t', 4=>'o', 5=>'k']));
    $grid->addElement(new GridElement('q', [0=>'m', 1=>'r', 2=>'v', 3=>'u', 4=>'p', 5=>'l']));
    $grid->addElement(new GridElement('r', [0=>'n', 1=>null,2=>'w', 3=>'v', 4=>'q', 5=>'m']));

    $grid->addElement(new GridElement('s', [0=>'o', 1=>'t', 2=>null,3=>null,4=>null,5=>null]));
    $grid->addElement(new GridElement('t', [0=>'p', 1=>'u', 2=>null,3=>null,4=>'s', 5=>'o']));
    $grid->addElement(new GridElement('u', [0=>'q', 1=>'v', 2=>null,3=>null,4=>'t', 5=>'p']));
    $grid->addElement(new GridElement('v', [0=>'r', 1=>'w', 2=>null,3=>null,4=>'u', 5=>'q']));
    $grid->addElement(new GridElement('w', [0=>null,1=>null,2=>null,3=>null,4=>'v', 5=>'r']));

    return $grid;
}

$matrix = $matrixConverter->convert((new ElementCollection())
    ->add($grid->getElementBySign('a')->clearUnusedLine('afkg')->toElement())
    ->add($grid->getElementBySign('f')->clearUnusedLine('afkg')->toElement())
    ->add($grid->getElementBySign('k')->clearUnusedLine('afkg')->toElement())
    ->add($grid->getElementBySign('g')->clearUnusedLine('afkg')->toElement())
);

$matrixConverter->dumpMatrix($matrix);
