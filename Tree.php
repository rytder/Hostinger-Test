<?php

/**
 * Created by PhpStorm.
 * User: rytis
 * Date: 2018-04-03
 * Time: 20:48
 */
abstract class Tree
{

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public abstract function addSubCategory(Tree $object);

    public abstract function display($depth);

}

class CompositeObject extends Tree
{
    private $trees = array();
    private $count = 0;

    public function addSubCategory(Tree $object)
    {
        $this->trees[$this->count++] = $object;

        return $this;
    }

    public function display($depth)
    {
        echo str_repeat(' ', $depth) . $this->name . "\n";

        foreach ($this->trees as $tree) {
            echo $tree->display($depth + 1);
        }
    }
}

class Leaf extends Tree
{

    public function addSubCategory(Tree $object)
    {
        return false;
    }

    public function display($depth)
    {
        echo str_repeat(' ', $depth) . $this->name . "\n";
    }
}

$first   = new Leaf('sub-sub-cat');
$second  = new Leaf('sub-sub-cat');
$third   = new Leaf('sub-sub-cat');
$fourth  = new Leaf('sub-sub-cat');
$fifth   = new Leaf('sub-sub-cat');
$sixth   = new CompositeObject('sub-cat');
$seventh = new CompositeObject('sub-cat');
$eighth  = new CompositeObject('cat');
$ninth   = new CompositeObject('cat');
$main    = new CompositeObject('Tree');

$sixth->addSubCategory($first);
$sixth->addSubCategory($second);

$seventh->addSubCategory($third);
$seventh->addSubCategory($fourth);
$seventh->addSubCategory($fifth);

$eighth->addSubCategory($sixth);
$eighth->addSubCategory($seventh);

$main->addSubCategory($eighth);
$main->addSubCategory($ninth);
$main->display(1);
