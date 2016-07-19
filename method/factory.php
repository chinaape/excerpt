<?php

/**
 * Class AbsBill 抽象工厂类
 */
abstract class AbsBillFactory
{
    abstract public function invoice($str);

    abstract public function ticket($str);
}

/**
 * Class IndividualIFactory 个人发行机构
 */
class IndividualIFactory extends AbsBillFactory
{
    public function invoice($str)
    {
        return new IndInvoice();
    }

    public function ticket($str)
    {
        return new IndTicket();
    }
}

/**
 * Class CommonFactory 公共发行机构
 */
class CommonFactory extends AbsBillFactory
{
    public function invoice($str)
    {

    }

    public function ticket($str)
    {

    }
}

/**
 * Interface BillPro 票据制作单元接口
 */
abstract class BillPro
{
    protected $str = '';

    abstract function setStr($str);

    abstract function outBill();
}

/**
 * Class IndInvoice 个人发票生成单元
 */
class IndInvoice extends BillPro
{
    public function setStr($str)
    {
        $this->str = $str;
    }

    public function outBill()
    {
        return __CLASS__.':'.$this->str;
    }
}

/**
 * Class IndTicket 个人车票生成单元
 */
class IndTicket extends BillPro
{
    public function setStr($str)
    {
        // TODO: Implement setStr() method.
    }

    public function outBill()
    {
        // TODO: Implement outBill() method.
    }
}

$indInv = new IndividualIFactory();
$indInv->invoice('123')->outBill();

/**
 * Class AbsStr 抽象方法工厂
 */
abstract class AbsStr
{
    abstract public function getName($str);
    abstract public function setName();
}

class JsonStrFactory extends AbsStr
{
    public function getName($str)
    {
        return new JsonStr();
    }

    public function setName()
    {
        // TODO: Implement setName() method.
    }
}

interface Str
{
    public function resolve($str);
}

class JsonStr implements Str
{
    /**
     * @param $str
     * @return array
     */
    public function resolve($str)
    {
        return json_decode($str);
    }
}

