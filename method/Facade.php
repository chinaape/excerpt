<?php

/**
 * 外观模式：通过必须的逻辑和方法的集合前创建简单的外观接口，外观模式隐藏了来自调用对象的复杂性
 */
class Products
{
    public $data;

    public function add($title, $price)
    {
        $serializeData = array('title' => $title, 'price' => $price);
        $this->data[] = $serializeData;
    }
}

class ProUpperCase
{
    protected $pro;

    public static function toUpper(Products $pro)
    {
        if (empty($pro->data)) return false;

        foreach ($pro->data as $key => $item) {
            $pro->data[$key]['title'] = strtoupper($item['title']);
            $pro->data[$key]['price'] = number_format($item['price'], 2);
        }
    }
}

class ProToXml
{
    public static function makeXml(Products $pro)
    {
        $dom = new DOMDocument( "1.0", 'utf-8');
        $xmlRoot = $dom->createElement('root');
        $dom->appendChild($xmlRoot);

        $xmlProList = $dom->createElement('prolist');
        $xmlRoot->appendChild($xmlProList);

        foreach ($pro->data as $item) {
            $xmlProInfo = $dom->createElement('proinfo');
            $xmlProList->appendChild($xmlProInfo);

            $xmlProAttrTitle = $dom->createAttribute('title');
            $xmlProInfo->appendChild($xmlProAttrTitle);

            $xmlProAttrTitleValue = $dom->createTextNode($item['title']);
            $xmlProAttrTitle->appendChild($xmlProAttrTitleValue);

            $xmlProAttrPrice = $dom->createAttribute('price');
            $xmlProInfo->appendChild($xmlProAttrPrice);

            $xmlProAttrPriceValue = $dom->createTextNode($item['price']);
            $xmlProAttrPrice->appendChild($xmlProAttrPriceValue);

            $xmlProInfoText = $dom->createTextNode($item['title']);
            $xmlProInfo->appendChild($xmlProInfoText);
        }

        return $dom->saveXML();
    }
}

class WebServiceFacade
{
    private static $proObj;

    public function makeXml()
    {
        $pro = self::newPro();
        $pro->add('merz', 20.367);
        ProUpperCase::toUpper($pro);

        return ProToXml::makeXml($pro);
    }

    private static function newPro()
    {
        
        if (null == self::$proObj) {
            self::$proObj = new Products();
        }

        return self::$proObj;
    }
}
header( 'Content-Type:text/xml');

$server = new WebServiceFacade();
echo $server->makeXml();