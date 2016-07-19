<?php

/**
 * 装饰模式：如果已有对象的内容或功能发生改变，但不需要修改原有对象的结构，那么使用装饰模式最为合适
 */
class CD
{
    public $tack = array();

    public function addTack($tack)
    {
        $this->tack = $tack;
    }

    public function payTack()
    {
        $str = '';
        foreach ($this->tack as $key => $value) {
            $str .= 'key:' . $key . ',value:' . $value . '<br>';
        }

        return $str;
    }
}

class DecoratorCD
{
    private $cdObj = '';

    public function __construct(CD $cd)
    {
        $this->cdObj = $cd; // 必须的一步
    }

    public function supPayTack()
    {
        $str = '';
        foreach ($this->cdObj->tack as $key => $value) {
            $str .= 'key:' . $key . ',value:' . strtoupper($value) . '<br>';
        }

        return $str;
    }
}

$cd = new CD();
$cd->addTack(array('hid','sss'));
echo $cd->payTack();

$dCD = new DecoratorCD($cd);
echo $dCD->supPayTack();