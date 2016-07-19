<?php

/**
 * 解释模式：用于分析一个实体的关键元素，并针对每个元素提供自己的解释或相应的动作
 */
class User
{
    public function getProFilePage()
    {
        $proFile = '<h3>I like never again!</h3>';
        $proFile .= 'I love all of their songs. My favorite:CD<br>';
        $proFile .= '{{myCD.getTitle}},price:{{myCD.getPrice}}$';

        return $proFile;
    }
}

class UserCD
{
    protected $user = null;

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getTitle()
    {
        $title = 'waste of a Rib';

        return $title;
    }

    public function getPrice()
    {
        $price = 20;

        return $price;
    }
}

class UserCDInterpreter
{
    protected $user = null;

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getInterpreter()
    {
        $proFile = $this->user->getProFilePage();
        $myCd = new UserCD();
        preg_match_all('/{{myCD.(.*?)}}/', $proFile, $data);

        if (empty($data['1'])) {

            return false;
        }

        $method = array_unique(array_filter($data['1']));

        foreach ($method as $item) {
            $proFile = preg_replace('/{{myCD.'.$item.'}}/', call_user_func(array($myCd, $item)),$proFile);
        }

        echo $proFile;
    }
}

$user = new User();
$userInter = new UserCDInterpreter();
$userInter->setUser($user);
$userInter->getInterpreter();
