<?php
namespace App;

use Hg\Yokohena20170401\Grid;
use Hg\Yokohena20170401\GridElement;
use Hg\Yokohena20170401\StructureMatrix\ElementCollection;
use Hg\Yokohena20170401\StructureMatrix\ToStructureMatrix;

require_once __DIR__.'/vendor/autoload.php';

$matrixConverter = new ToStructureMatrix();
$grid = initGrid();
$matchers = initMatchers();

function solve($input)
{
    global $grid, $matrixConverter;

    $elementCollection = new ElementCollection();
    array_map(function($index) use ($grid, $input, $elementCollection) {
        $elementCollection->add($grid->getElementBySign($input[$index])->clearUnusedLine($input)->toElement());
    }, [0,1,2,3]);

    $matrix = $matrixConverter->convert($elementCollection);

    return match($matrix);
}

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

function initMatchers()
{
    global $grid, $matrixConverter;

    $matchers = [];
    $matchers['B'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('a')->clearUnusedLine('afkg')->toElement())
        ->add($grid->getElementBySign('f')->clearUnusedLine('afkg')->toElement())
        ->add($grid->getElementBySign('k')->clearUnusedLine('afkg')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('afkg')->toElement())
    );
    $matchers['D'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('f')->clearUnusedLine('fkgc')->toElement())
        ->add($grid->getElementBySign('k')->clearUnusedLine('fkgc')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('fkgc')->toElement())
        ->add($grid->getElementBySign('c')->clearUnusedLine('fkgc')->toElement())
    );
    $matchers['I'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('a')->clearUnusedLine('abcd')->toElement())
        ->add($grid->getElementBySign('b')->clearUnusedLine('abcd')->toElement())
        ->add($grid->getElementBySign('c')->clearUnusedLine('abcd')->toElement())
        ->add($grid->getElementBySign('d')->clearUnusedLine('abcd')->toElement())
    );
    $matchers['J'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('c')->clearUnusedLine('cgjk')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('cgjk')->toElement())
        ->add($grid->getElementBySign('j')->clearUnusedLine('cgjk')->toElement())
        ->add($grid->getElementBySign('k')->clearUnusedLine('cgjk')->toElement())
    );
    $matchers['L'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('a')->clearUnusedLine('afkl')->toElement())
        ->add($grid->getElementBySign('f')->clearUnusedLine('afkl')->toElement())
        ->add($grid->getElementBySign('k')->clearUnusedLine('afkl')->toElement())
        ->add($grid->getElementBySign('l')->clearUnusedLine('afkl')->toElement())
    );
    $matchers['N'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('f')->clearUnusedLine('fbch')->toElement())
        ->add($grid->getElementBySign('b')->clearUnusedLine('fbch')->toElement())
        ->add($grid->getElementBySign('c')->clearUnusedLine('fbch')->toElement())
        ->add($grid->getElementBySign('h')->clearUnusedLine('fbch')->toElement())
    );
    $matchers['O'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('b')->clearUnusedLine('bfgk')->toElement())
        ->add($grid->getElementBySign('f')->clearUnusedLine('bfgk')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('bfgk')->toElement())
        ->add($grid->getElementBySign('k')->clearUnusedLine('bfgk')->toElement())
    );
    $matchers['S'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('a')->clearUnusedLine('afgl')->toElement())
        ->add($grid->getElementBySign('f')->clearUnusedLine('afgl')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('afgl')->toElement())
        ->add($grid->getElementBySign('l')->clearUnusedLine('afgl')->toElement())
    );
    $matchers['Y'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('a')->clearUnusedLine('afgj')->toElement())
        ->add($grid->getElementBySign('f')->clearUnusedLine('afgj')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('afgj')->toElement())
        ->add($grid->getElementBySign('j')->clearUnusedLine('afgj')->toElement())
    );
    $matchers['Z'] = $matrixConverter->convert((new ElementCollection())
        ->add($grid->getElementBySign('j')->clearUnusedLine('jfgc')->toElement())
        ->add($grid->getElementBySign('f')->clearUnusedLine('jfgc')->toElement())
        ->add($grid->getElementBySign('g')->clearUnusedLine('jfgc')->toElement())
        ->add($grid->getElementBySign('c')->clearUnusedLine('jfgc')->toElement())
    );

    return $matchers;
}

/**
 * @param $result
 * @return string
 */
function match($result)
{
    global $matchers;

    foreach ($matchers as $patten=>$matrix) {
        if ($matrix === $result) return $patten;
    }

    return '-';
}

function test($input, $expected)
{
    $result = solve($input);

    if ($result === $expected) {
        echo 'OK: ' . $input . ' result: ' . $result;
    } else {
        echo 'NG: ' . $input . ' calculated: ' . $result . ' (expected: ' . $expected . ')';
    }

    echo PHP_EOL;
}

/*0*/ test( "glmq", "B" );
/*1*/ test( "fhoq", "-" );
/*2*/ test( "lmpr", "N" );
/*3*/ test( "glmp", "Y" );
/*4*/ test( "dhkl", "J" );
/*5*/ test( "glpq", "D" );
/*6*/ test( "hlmq", "O" );
/*7*/ test( "eimq", "I" );
/*8*/ test( "cglp", "S" );
/*9*/ test( "chlq", "Z" );
/*10*/ test( "glqr", "L" );
/*11*/ test( "cdef", "-" );
/*12*/ test( "hijk", "-" );
/*13*/ test( "kpqu", "B" );
/*14*/ test( "hklm", "B" );
/*15*/ test( "mqrw", "B" );
/*16*/ test( "nrvw", "B" );
/*17*/ test( "abfj", "B" );
/*18*/ test( "abcf", "B" );
/*19*/ test( "mrvw", "D" );
/*20*/ test( "ptuv", "D" );
/*21*/ test( "lmnr", "D" );
/*22*/ test( "hklp", "D" );
/*23*/ test( "himr", "D" );
/*24*/ test( "dhil", "D" );
/*25*/ test( "hlpt", "I" );
/*26*/ test( "stuv", "I" );
/*27*/ test( "bglq", "I" );
/*28*/ test( "glmn", "-" );
/*29*/ test( "fghm", "J" );
/*30*/ test( "cdgk", "-" );
/*31*/ test( "lpst", "J" );
/*32*/ test( "imrw", "-" );
/*33*/ test( "dinr", "J" );
/*34*/ test( "cdin", "-" );
/*35*/ test( "eghi", "-" );
/*36*/ test( "cdeg", "L" );
/*37*/ test( "bgko", "-" );
/*38*/ test( "eimr", "L" );
/*39*/ test( "jotu", "L" );
/*40*/ test( "kotu", "-" );
/*41*/ test( "lqtu", "N" );
/*42*/ test( "cdim", "N" );
/*43*/ test( "klot", "-" );
/*44*/ test( "kloq", "N" );
/*45*/ test( "kmpq", "-" );
/*46*/ test( "qrvw", "O" );
/*47*/ test( "mnqr", "O" );
/*48*/ test( "kopt", "O" );
/*49*/ test( "mnpq", "S" );
/*50*/ test( "bfko", "S" );
/*51*/ test( "chin", "S" );
/*52*/ test( "hmnq", "Y" );
/*53*/ test( "nqrw", "Y" );
/*54*/ test( "bchi", "Z" );
/*55*/ test( "inrw", "Z" );
/*56*/ test( "cfgj", "Z" );
/*57*/ test( "jnpv", "-" );
/*58*/ test( "flmp", "-" );
/*59*/ test( "adpw", "-" );
/*60*/ test( "eilr", "-" );
/*61*/ test( "bejv", "-" );
/*62*/ test( "enot", "-" );
/*63*/ test( "fghq", "-" );
/*64*/ test( "cjms", "-" );
/*65*/ test( "elov", "-" );
/*66*/ test( "chlm", "D" );
/*67*/ test( "acop", "-" );
/*68*/ test( "finr", "-" );
/*69*/ test( "qstu", "-" );
/*70*/ test( "abdq", "-" );
