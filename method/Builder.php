<?php

/**
 * 建造模式：定义了处理其他对象的复杂结构的设计
 */
class Product
{
    private $_size, $_color;

    public function setSize($size)
    {
        $this->_size = $size;
    }

    public function setColor($color)
    {
        $this->_color = $color;
    }
}

class Bulider
{
    private $_config = array();
    private $_pro = '';

    public function setConfig($config)
    {
        $this->_config = $config;
        $this->_pro = new Product();
    }

    public function getProduct()
    {
        $this->_pro->setSize($this->_config['size']);
        $this->_pro->setColor($this->_config['color']);
    }
}

$pro = new Bulider();
$pro->setConfig(array('size' => 16, 'color' => 'red'));
$pro->getProduct();