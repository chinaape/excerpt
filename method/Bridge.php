<?php

/**
 * 桥梁模式（Bridge）也叫做桥接模式，用于将抽象和实现解耦，使得两者可以独立地变化。
 * 桥梁模式完全是为了解决继承的缺点而提出的设计模式。在该模式下，实现可以不受抽象的约束，不用再绑定在一个固定的抽象层次上。
 */
interface WorkShop
{
    function work();
}

class Assemble implements WorkShop
{
    public function work()
    {
        // TODO: Implement work() method.
        echo 'Assemble';
    }
}

class Product implements WorkShop
{
    public function work()
    {
        // TODO: Implement work() method.
        echo 'Product';
    }
}

abstract class Vehicle
{
    protected $workOne;
    protected $workTwo;

    public function __construct(WorkShop $shop1, WorkShop $shop2)
    {
        $this->workOne = $shop1;
        $this->workTwo = $shop2;
    }

    abstract public function manufacture();
}

class Motorcycle extends Vehicle
{
    public function __construct(WorkShop $shop1, WorkShop $shop2)
    {
        parent::__construct($shop1, $shop2);
    }

    public function manufacture()
    {
        $this->workOne->work();
    }
}

class Car extends  Vehicle
{
    public function __construct(WorkShop $shop1, WorkShop $shop2)
    {
        parent::__construct($shop1, $shop2);
    }

    public function manufacture()
    {
        // TODO: Implement manufacture() method.
        $this->workTwo->work();
    }
}

$brige1 = new Motorcycle(new Assemble(), new Product());
$brige1->manufacture();

$brige2 = new Car(new Assemble(), new Product());
$brige2->manufacture();